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
 * @api {get} /certificates Get certificates
 * @apiName Get Certificates
 * @apiDescription Get all available certificates
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
 * @apiName subscribe to certificate
 * @apiDescription Relates a certificate with the current user
 * @apiGroup Certificates
 * @apiHeader {String} session-token Session unique token. Obtained in call <em>Get Session Token</em>.
 *
 * @apiParam {Integer} certificate_id (conditional) Certficate's wanted to subscribe to id. Obligatory if not <em>certificate_ids</em> is provided.
 * @apiParam {Array} certificate_ids (conditional) Array with certficates's wanted to subscribe to ids. Obligatory if not <em>certificate_id</em> is provided.
 *
 * @apiSuccess {Array} data An array with current subscribed certificates.
 * @apiSuccess {Array} errors An array with errors.
 */


$router->post('/certificates',[
    'as' => 'add certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@add',
]);


/**
 * @api {delete} /certificates Unsubscribe to certificate
 * @apiName unsubscribet to certificate
 * @apiDescription Delete a relation of a certificate with the current user
 * @apiGroup Certificates
 * @apiHeader {String} session-token Session unique token. Obtained in call <em>Get Session Token</em>.
 *
 * @apiParam {Integer} certificate_id (conditional) Certficate's wanted to unsubscribe to id. Obligatory if not <em>certificate_ids</em> is provided.
 * @apiParam {Array} certificate_ids (conditional) Array with certficates's wanted to unsubscribe to ids. Obligatory if not <em>certificate_id</em> is provided.
 *
 * @apiSuccess {Array} data An array with current subscribed certificates.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->delete('/certificates',[
    'as' => 'remove certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@remove',
]);