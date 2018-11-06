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

$router->get('/certificates',[
    'as' => 'get certificates',
    'uses' => 'CertificateController@get',
]);