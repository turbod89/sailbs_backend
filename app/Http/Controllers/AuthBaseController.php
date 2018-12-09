<?php

namespace App\Http\Controllers;

use App\Role;
use App\Token;
use App\User;
use Illuminate\Http\Request;

/*
 *
 *
 * */


class AuthBaseController extends BaseController
{

    const DEFAULT_USER_ROLE = 'student';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function login(Request $request) {
        $instance = new BaseController();

        $username = $request->input('username');
        $password = $request->input('password');


        $user = User::where([
            ['username', $username],
            ['hashed_password', md5($password)],
        ])->first();

        if (is_null($user)) {
            $instance->addError(1, 'Wrong username or password');
            return $instance->jsonData(null,401);
        }

        // update auth token
        Token::session()->user = $user;
        Token::session()->save();

        return $instance->jsonData();
    }

    public function logout(Request $request) {

        // update auth token
        $authToken = Token::session();
        $authToken->user_id = null;
        $authToken->save();

        $instance = new BaseController();

        return $instance->jsonData();
    }

    public function signup(Request $request) {
        $instance = new BaseController();

        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $role_code = self::DEFAULT_USER_ROLE;
        $role = Role::where('code',$role_code)->first();

        // security
        $is_secure = true;
        $is_secure = $is_secure ? $this->checkPasswordStrength($password) : false;
        $is_secure = $is_secure ? $this->checkUsernameSecurity($username) : false;
        $is_secure = $is_secure ? $this->checkEmail($email) : false;

        if (!$is_secure) {
            $instance->addError(1,'This credentials are not valid due to format or security.');
            return $instance->jsonData(null,401);
        }

        // disposable
        $is_allowed = $is_secure;

        $is_allowed = $is_allowed ? (!User::where([['username',$username]])->exists()) : false;
        $is_allowed = $is_allowed ? (!User::where([['email', $email]])->exists()) : false;

        if (!$is_allowed) {
            $instance->addError(1,'This credentials are not valid: username or email are not available.');
            return $instance->jsonData(null,401);
        }

        // register

        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role_id' => $role->id,
        ]);

        $user->save();

        // login

        return $this->login($request);

    }

    private function checkEmail($email) {
        return is_string($email)
            && filter_var($email, FILTER_VALIDATE_EMAIL)
            && preg_match('/@.+\./', $email);
    }

    private function checkUsernameSecurity($username) {
        return is_string($username) && strlen($username) > 3;
    }

    private function checkPasswordStrength($password) {
        return is_string($password) && strlen($password) > 3;
    }
}

