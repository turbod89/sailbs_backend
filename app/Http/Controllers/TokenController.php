<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TokenController extends BaseController
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

    public function getAuthToken(Request  $request) {

        $tokenValue = null;

        $instance = new BaseController();


        if ($request->has('api_token') ) {
            $tokenValue = $request->input('api_token');
        } else if ( $request->headers->has('api-token') ) {
            $tokenValue = $request->header('api-token');
        }

        $token = Token::where([
            ['type','api token'],
            ['value',$tokenValue],
        ])->first();

        if (is_null($token)) {
            return response()->json([
                'errors' => [
                    [
                        'code' => 1,
                        'message' => 'Unauthorized API token.'
                    ],
                ]
            ],401);
        }

        $authToken = new Token([
            'type' => 'auth token',
            'value' => md5(''.(1000*microtime(true))),
            'expire_at' => Carbon::now()->addDays(7),
        ]);

        $authToken->api = $token->api;
        $authToken->save();

        return $instance->jsonData([
                'auth_token' => $authToken->only(['value','expire_at']),
            ]);
    }
}
