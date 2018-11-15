<?php


/*
 |------------------------------------------------
 | Certificates
 |------------------------------------------------
 |
 |
 |
 */

/**
 * @api {get} /me Get my profile
 * @apiName Get Certificates
 * @apiDescription Get profile of current user
 * @apiGroup Profile
 *
 * @apiSuccess {Array} data Profile data.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->get('/me',[
    'as' => 'get certificates',
    'middleware' => 'auth',
    'uses' => 'ProfileController@getMe',
]);