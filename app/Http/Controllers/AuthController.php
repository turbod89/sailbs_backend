<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Auth Controller
|--------------------------------------------------------------------------
|
| This class is an extension of AuthBaseController.
| All logic should be in the parent class AuthBaseController. When create a
| new function on parent class, then just overload it here as login or
| sign up examples.
|
|
*/

class AuthController extends AuthBaseController
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


    public static function getAuthToken(Request $request, callable $onSuccess, callable $onError) {
        $headerValue = null;

        if ($request->has('Authorization') ) {
            $headerValue = $request->input('Authorization');
        } else if ( $request->headers->has('Authorization') ) {
            $headerValue = $request->header('Authorization');
        }

        $matches = [];
        preg_match('/^Bearer ([^ ]+)/',$headerValue,$matches);

        $tokenValue = null;
        if (count($matches) > 1) {
            $tokenValue = $matches[1];
        }

        $authToken = Token::where([
            ['type', 'auth token'],
            ['value' , $tokenValue],
        ])->first();

        Token::session($authToken);

        if (is_null($authToken)) {
            return $onError($request);
        }

        return $onSuccess($request);
    }

    public static function unauthorizedAuthToken() {
        $instance = new BaseController();
        $instance->addError(1,'Unauthorized auth token.');
        return $instance->jsonData(null,401);
    }


    public function login(Request $request) {
        return self::getAuthToken(
            $request,
            function (Request $request) {
                return parent::login($request);
            },
            [self::class, 'unauthorizedAuthToken']
        );
    }

    public function logout(Request $request) {
        return self::getAuthToken(
            $request,
            function (Request $request) {
                return parent::logout($request);
            },
            [self::class, 'unauthorizedAuthToken']
        );
    }

    public function signup(Request $request) {
        return self::getAuthToken(
            $request,
            function (Request $request) {
                return parent::signup($request);
            },
            [self::class, 'unauthorizedAuthToken']
        );
    }


}

