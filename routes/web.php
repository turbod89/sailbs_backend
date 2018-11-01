<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
 |------------------------------------------------
 | Tokens
 |------------------------------------------------
 |
 |
 |
 */

/**
 * @api {get} /tokens Get Session Token
 * @apiName GetToken
 * @apiGroup Token
 *
 * @apiHeader {String} api-token Your application token.
 *
 * @apiSuccess {Array} errors An array with errors.
 */

$router->get('/tokens',[
    'as' => 'getToken',
    'uses' => 'TokenController@getSessionToken',
]);

/*
 |------------------------------------------------
 | Auth
 |------------------------------------------------
 |
 |
 |
 */

/**
 * @api {post} /auth User Login
 * @apiName Login
 * @apiGroup Authorization
 * @apiHeader {String} session-token Session unique token. Obtained in call <em>Get Session Token</em>.
 *
 * @apiParam {String} username Username.
 * @apiParam {String} password User's password.
 *
 * @apiSuccess {Array} errors An array with errors.
 */

$router->post('/auth',[
    'as' => 'login',
    'uses' => 'AuthController@login',
]);

$router->post('/auth/login',[
    'as' => 'login',
    'uses' => 'AuthController@login',
]);


/**
 * @api {delete} /auth User Logout
 * @apiName Logout
 * @apiGroup Authorization
 *
 * @apiHeader {String} session-token Session unique token. Obtained in call <em>Get Session Token</em>.
 *
 * @apiSuccess {Array} errors An array with errors.
 */

$router->delete('/auth',[
    'as' => 'logout',
    'uses' => 'AuthController@logout',
]);

$router->get('/auth/logout',[
    'as' => 'logout',
    'uses' => 'AuthController@logout',
]);


/**
 * @api {post} /auth/signup User Signup
 * @apiName Signup
 * @apiGroup Authorization
 *
 * @apiHeader {String} session-token Session unique token. Obtained in call <em>Get Session Token</em>.
 *
 * @apiParam {String} username Username.
 * @apiParam {String} password User's password.
 * @apiParam {String} email User's email.
 *
 * @apiSuccess {Array} errors An array with errors.
 */

$router->post('/auth/signup',[
    'as' => 'login',
    'uses' => 'AuthController@signup',
]);