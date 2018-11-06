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
 * @api {post} /certificates All certificates
 * @apiName Get Certificates
 * @apiGroup Certificates
 *
 * @apiSuccess {Array} data An array with all certificates.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->get('/certificates',[
    'as' => 'get certificates',
    'uses' => 'CertificateController@get',
]);

/**
 * @api {post} /certificates Subscribe to certificate
 * @apiName Relates a certificate with the current user
 * @apiGroup Certificates
 * @apiHeader {String} session-token Session unique token. Obtained in call <em>Get Session Token</em>.
 *
 * @apiParam {Integer} certificate_id Certficate's wanted to subscribe to id.
 *
 * @apiSuccess {Array} data An array with current subscribed certificates.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->post('/certificates',[
    'as' => 'add certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@add',
]);