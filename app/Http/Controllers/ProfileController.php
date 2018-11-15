<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class ProfileController extends BaseController
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


    public function getMe(Request $request) {

        $user = $request->user();

        return response()->json([
            'data' => $user,
            'errors' => [],
        ]);
    }

}
