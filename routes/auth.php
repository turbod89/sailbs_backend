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
 * @apiDefine AuthRequests
 * @apiHeader (Headers) {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
 * @apiSuccess {Array} errors An array with errors.
 * @apiSuccessExample {json} Success-Base-Example:
 *  {
 *      "data": null,
 *      "errors": [<error>, ...]
 *
 * }
 */

/**
 * @apiUse AuthRequests
 * @apiGroup Authorization
 *
 * @api {post} /auth User Login
 * @apiName Login
 * @apiDescription Logs an user in.
 *
 * @apiParam (Body) {String} username Username.
 * @apiParam (Body) {String} password User's password.
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
 * @apiUse AuthRequests
 * @apiGroup Authorization
 *
 * @api {delete} /auth User Logout
 * @apiName Logout
 * @apiDescription Logs an user out.
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
 * @apiUse AuthRequests
 * @apiGroup Authorization
 *
 * @api {post} /auth/signup User Signup
 * @apiName Signup
 * @apiDescription Register an user and, if success, loges in.
 *
 * @apiParam (Body) {String} username Username.
 * @apiParam (Body) {String} password User's password.
 * @apiParam (Body) {String} email User's email.
 */

$router->post('/auth/signup',[
    'as' => 'login',
    'uses' => 'AuthController@signup',
]);