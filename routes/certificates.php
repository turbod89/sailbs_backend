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
    'uses' => 'CertificateController@getAll',
]);


/**
 * @api {get} /me/certificates Get user certificates
 * @apiName Get user certificates
 * @apiDescription Get all certificates current user is subscribed to
 * @apiGroup Certificates
 * @apiHeader {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
 *
 * @apiSuccess {Array} data An array with current subscribed certificates.
 * @apiSuccess {Array} errors An array with errors.
 */


$router->get('/me/certificates',[
    'as' => 'get my certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@get',
]);



/**
 * @api {post} /me/certificates Subscribe to certificate
 * @apiName subscribe to certificate
 * @apiDescription Relates a certificate with the current user
 * @apiGroup Certificates
 * @apiHeader {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
 *
 * @apiParam {Integer} certificate_id (optional) Certficate's wanted to subscribe to id.
 * @apiParam {Array} certificate_ids (optional) Array with certficates's wanted to subscribe to ids.
 * @apiParam {String} certificate_code (optional) Certficate's wanted to subscribe to code.
 * @apiParam {Array} certificate_codes (optional) Array with certficates's wanted to subscribe to codes.
 *
 * @apiParam {Integer} user_id (optional) User who wanted to subscribe to id. If no user provided, logged user will be used.
 * @apiParam {Array} user_ids (optional) Array with users whose wanted to subscribe to ids. If no user provided, logged user will be used.
 *
 * @apiParamExample {json} Subscribe-Example:
 *     {
 *       "certificate_codes": [
 *              "PNB",
 *              "PER"
 *          ]
 *     }
 *
 * @apiSuccess {Array} data An array with the pairs (user, certificate) successfully subscribed.
 * @apiSuccess {Array} errors An array with errors.
 */


$router->post('/me/certificates',[
    'as' => 'add certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@add',
]);


/**
 * @api {delete} /me/certificates Unsubscribe to certificate
 * @apiName unsubscribe to certificate
 * @apiDescription Delete a relation of a certificate with the current user
 * @apiGroup Certificates
 * @apiHeader {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
 *
 * @apiParam {Integer} certificate_id (optional) Certficate's wanted to unsubscribe to id.
 * @apiParam {Array} certificate_ids (optional) Array with certficates's wanted to unsubscribe to ids.
 * @apiParam {String} certificate_code (optional) Certficate's wanted to unsubscribe to code.
 * @apiParam {Array} certificate_codes (optional) Array with certficates's wanted to unsubscribe to codes.
 *
 * @apiParam {Integer} user_id (optional) User who wanted to unsubscribe to id.
 * @apiParam {Array} user_ids (optional) Array with users whose wanted to unsubscribe to ids.
 *
 * @apiParamExample {json} Unsubscribe-Example:
 *     {
 *       "certificate_codes": [
 *              "PNB",
 *              "PER"
 *          ]
 *     }
 *
 * @apiSuccess {Array} data An array with the pairs (user, certificate) successfully unsubscribed.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->delete('/me/certificates',[
    'as' => 'remove certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@remove',
]);