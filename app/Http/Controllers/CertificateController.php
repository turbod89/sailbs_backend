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
     * @param Integer $certificate_id
     * @param User $user
     * @return $this
     */
    private function _addCertificateToUser($certificate_id, User $user) {

        $certificate = Certificate::find($certificate_id);

        if (empty($certificate)) {
            $this->addError(
                1,
                "Provided certificate_id '${certificate_id}' is not valid."
            );
            return $this;
        }


        if ($user->cannot('add', $certificate)) {
            $this->addError(
                1,
                "Provided certificate_id '${certificate_id}' is not valid."
            );
            return $this;
        }

        $user->certificates()->syncWithoutDetaching([
            $certificate->id => ['role_id' => 0]
        ]);

        return $this;
    }

    /**
     * @param Integer $certificate_id
     * @param User $user
     * @return $this
     */
    private function _removeCertificateToUser($certificate_id, User $user) {

        $certificate = Certificate::find($certificate_id);

        if (empty($certificate)) {
            $this->addError(
                1,
                "Provided certificate_id '${certificate_id}' is not valid."
            );
            return $this;
        }


        if ($user->cannot('add', $certificate)) {
            $this->addError(
                1,
                "Provided certificate_id '${certificate_id}' is not valid."
            );
            return $this;
        }

        $user->certificates()->detach([
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

        $user = $request->user();
        $certificate_id = $request->input('certificate_id', null);
        $certificate_ids = $request->input('certificate_ids',[]);

        if (!empty($certificate_id)) {
            $certificate_ids[] = $certificate_id;
        }

        foreach ($certificate_ids as $certificate_id) {
            $this->_addCertificateToUser($certificate_id,$user);
        }

        return response()->json([
            'data' => $user->certificates,
            'errors' => $this->getErrors(),
        ]);
    }

    public function remove(Request $request) {

        $user = $request->user();
        $certificate_id = $request->input('certificate_id', null);
        $certificate_ids = $request->input('certificate_ids',[]);

        if (!empty($certificate_id)) {
            $certificate_ids[] = $certificate_id;
        }

        foreach ($certificate_ids as $certificate_id) {
            $this->_removeCertificateToUser($certificate_id,$user);
        }

        return response()->json([
            'data' => $user->certificates,
            'errors' => $this->getErrors(),
        ]);
    }
}
