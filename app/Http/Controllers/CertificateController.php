<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class CertificateController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param User $user
     * @param Certificate $certificate
     * @param User $user_target
     * @return $this
     */
    private function _addCertificateToUser(User $user, Certificate $certificate, User $user_target) {

        if ($user->cannot('add', [$certificate, $user_target])) {
            $this->addError(
                1,
                "Not allowed to do this action"
            );
            return $this;
        }

        $user_target->certificates()->syncWithoutDetaching([
            $certificate->id => ['role_id' => 0]
        ]);

        return $this;
    }

    /**
     * @param User $user
     * @param Certificate $certificate
     * @param User $user_target
     * @return $this
     */
    private function _removeCertificateToUser(User $user, Certificate $certificate, User $user_target) {

        if ($user->cannot('remove', [$certificate, $user_target])) {
            $this->addError(
                1,
                "Not allowed to do this action"
            );
            return $this;
        }

        $user_target->certificates()->detach([
            $certificate->id
        ]);

        return $this;
    }

    public function getAll(Request $request) {

        $certificates = Certificate::all();

        return response()->json([
            'data' => $certificates,
            'errors' => [],
        ]);
    }

    public function get(Request $request) {

        $user = $request->user();

        $certificates = $user->certificates;


        return response()->json([
            'data' => $certificates,
            'errors' => [],
        ]);
    }

    public function add(Request $request) {

        $request_data = null;
        if ($request->isJson()) {
            $request_data = $request->json()->all();
        } else {
            $request_data = $request->all();
        }

        $user = $request->user();

        $certificate_id = isset($request_data['certificate_id']) ? $request_data['certificate_id'] : null;
        $certificate_ids = isset($request_data['certificate_ids']) ? $request_data['certificate_ids'] : [];

        $certificate_code = isset($request_data['certificate_code']) ? $request_data['certificate_code'] : null;
        $certificate_codes = isset($request_data['certificate_codes']) ? $request_data['certificate_codes'] : [];

        $user_id = $request->input('user_id', null);
        $user_ids = $request->input('user_ids',[]);

        if (!empty($certificate_id)) {
            $certificate_ids[] = $certificate_id;
        }

        if (!empty($certificate_code)) {
            $certificate_codes[] = $certificate_code;
        }

        if (!empty($user_ids)) {
            $user_ids[] = $user_id;
        }

        if (empty($user_ids)) {
            $user_ids[] = $request->user()->id;
        }

        $certificates = Certificate::whereIn('id',$certificate_ids)->orWhereIn('code',$certificate_codes)->get();
        $users = User::whereIn('id',$user_ids)->get();

        $return_data = [];

        foreach ($users as $user_target) {
            foreach ($certificates as $certificate) {
                $this->_addCertificateToUser($user, $certificate, $user_target);
                $return_data[] = [
                    "user" => $user->id,
                    "certificate" => $certificate->code
                ];
            }
        }

        return $this->jsonData($return_data);
    }

    public function remove(Request $request) {

        $request_data = null;
        if ($request->isJson()) {
            $request_data = $request->json()->all();
        } else {
            $request_data = $request->all();
        }

        $user = $request->user();

        $certificate_id = isset($request_data['certificate_id']) ? $request_data['certificate_id'] : null;
        $certificate_ids = isset($request_data['certificate_ids']) ? $request_data['certificate_ids'] : [];

        $certificate_code = isset($request_data['certificate_code']) ? $request_data['certificate_code'] : null;
        $certificate_codes = isset($request_data['certificate_codes']) ? $request_data['certificate_codes'] : [];

        $user_id = $request->input('user_id', null);
        $user_ids = $request->input('user_ids',[]);

        if (!empty($certificate_id)) {
            $certificate_ids[] = $certificate_id;
        }

        if (!empty($certificate_code)) {
            $certificate_codes[] = $certificate_code;
        }

        if (!empty($user_ids)) {
            $user_ids[] = $user_id;
        }

        if (empty($user_ids)) {
            $user_ids[] = $request->user()->id;
        }

        $certificates = Certificate::whereIn('id',$certificate_ids)->orWhereIn('code',$certificate_codes)->get();
        $users = User::whereIn('id',$user_ids)->get();

        $return_data = [];
        foreach ($users as $user_target) {
            foreach ($certificates as $certificate) {
                $this->_removeCertificateToUser($user, $certificate, $user_target);
                $return_data[] = [
                    "user" => $user->id,
                    "certificate" => $certificate->code
                ];
            }
        }

        return $this->jsonData($return_data);
    }
}
