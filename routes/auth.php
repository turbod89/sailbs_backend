<?php


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
 * @apiHeader {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
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
 * @apiHeader {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
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
 * @apiHeader {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
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