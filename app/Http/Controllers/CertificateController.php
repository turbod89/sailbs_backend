<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;

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

    public function get(Request $request) {

        $certificates = Certificate::all();

        return response()->json([
            'data' => $certificates,
            'errors' => [],
        ]);
    }

    public function add(Request $request) {

        $certificate_id = $request->input('certificate_id', null);
        $certificate = Certificate::find($certificate_id);

        if (empty($certificate)) {
            return response()->json(['errors' => [
                'No valid certificate_id provided.',
            ]]);
        }

        $user = $request->user();

        if ( $user->cannot('add',$certificate)) {
            return response()->json(['errors' => [
                'Action not allowed.',
            ]]);
        }

        $user->certificates()->syncWithoutDetaching([
            $certificate->id => ['role_id' => 0]
        ]);

        return response()->json([
            'data' => $user->certificates,
            'errors' => [],
        ]);
    }
}
