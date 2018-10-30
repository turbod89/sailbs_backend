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

$router->get('/token',[
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

$router->post('/auth',[
    'as' => 'login',
    'uses' => 'AuthController@login',
]);

$router->post('/auth/login',[
    'as' => 'login',
    'uses' => 'AuthController@login',
]);

$router->delete('/auth',[
    'as' => 'logout',
    'uses' => 'AuthController@logout',
]);

$router->get('/auth/logout',[
    'as' => 'logout',
    'uses' => 'AuthController@logout',
]);

$router->post('/auth/signup',[
    'as' => 'login',
    'uses' => 'AuthController@signup',
]);