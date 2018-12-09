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
 * @apiDefine CertificateRequests
 * @apiHeader (Headers) {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
 * @apiSuccess {Array} errors An array with errors.
 */

/**
 * @apiUse CertificateRequests
 * @apiGroup Certificates
 *
 * @api {get} /certificates Get certificates
 * @apiName Get Certificates
 * @apiDescription Get all available certificates
 *
 * @apiSuccess {Array} data An array with all certificates.
 * @apiSuccessExample {json} Success-Base-Example-Response:
 *  {
 *     "data": [
 *         {
 *             "id": 1,
 *             "code": "PKKK",
 *             "deleted": 0,
 *             "created_at": "2018-12-05 15:04:24",
 *             "updated_at": "2018-12-05 15:04:24",
 *             "deleted_at": null,
 *             "name": "Título de PKKK",
 *             "short_name": "Título de PKKK",
 *             "description": "Este título es el de PKKK",
 *             "subjects": [
 *                 {
 *                     "id": 1,
 *                     "code": "SBJ1"
 *                 },
 *                 ...
 *             ]
 *         },
 *         ...
 *
 *      "errors": [<error>, ...]
 *
 * }
 */

$router->get('/certificates',[
    'as' => 'get certificates',
    'uses' => 'CertificateController@getAll',
]);


/**
 * @apiUse CertificateRequests
 * @apiGroup Certificates
 *
 * @api {get} /me/certificates Get user certificates
 * @apiName Get user certificates
 * @apiDescription Get all certificates current user is subscribed to
 *
 * @apiSuccess {Array} data An array with current subscribed certificates.
 * @apiSuccess {Array} errors An array with errors.
 * @apiSuccessExample {json} Success-Base-Example-Response:
 *  {
 *     "data": [
 *         {
 *             "id": 1,
 *             "code": "PKKK",
 *             "deleted": 0,
 *             "created_at": "2018-12-05 15:04:24",
 *             "updated_at": "2018-12-05 15:04:24",
 *             "deleted_at": null,
 *             "name": "Título de PKKK",
 *             "short_name": "Título de PKKK",
 *             "description": "Este título es el de PKKK",
 *             "subjects": [
 *                 {
 *                     "id": 1,
 *                     "code": "SBJ1"
 *                 },
 *                 ...
 *             ]
 *         },
 *         ...
 *
 *      "errors": [<error>, ...]
 *
 * }
 */


$router->get('/me/certificates',[
    'as' => 'get my certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@get',
]);



/**
 * @apiUse CertificateRequests
 * @apiGroup Certificates
 *
 * @api {post} /me/certificates Subscribe to certificate
 * @apiName subscribe to certificate
 * @apiDescription Relates a certificate with the current user
 *
 * @apiParam (Body) {Integer} certificate_id (optional) Certficate's wanted to subscribe to id.
 * @apiParam (Body) {Array} certificate_ids (optional) Array with certficates's wanted to subscribe to ids.
 * @apiParam (Body) {String} certificate_code (optional) Certficate's wanted to subscribe to code.
 * @apiParam (Body) {Array} certificate_codes (optional) Array with certficates's wanted to subscribe to codes.
 *
 * @apiParam (Body) {Integer} user_id (optional) User who wanted to subscribe to id. If no user provided, logged user will be used.
 * @apiParam (Body) {Array} user_ids (optional) Array with users whose wanted to subscribe to ids. If no user provided, logged user will be used.
 *
 * @apiParamExample {json} Subscribe-Example:
 *     {
 *       "certificate_codes": [
 *              "PKKK",
 *              "QPFZ"
 *          ]
 *     }
 *
 * @apiSuccess {Array} data An array with the pairs (user, certificate) successfully subscribed.
 * @apiSuccess {Array} errors An array with errors.
 * @apiSuccessExample {json} Subscribe-Example-Response:
 *  {
 *     "data": [
 *         {
 *             "user": 1,
 *             "certificate": "PKKK"
 *         },
 *         {
 *             "user": 1,
 *             "certificate": "QPFZ"
 *         }
 *      ],
 *      "errors": [<error>, ...]
 *
 * }
 */


$router->post('/me/certificates',[
    'as' => 'add certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@add',
]);


/**
 * @apiUse CertificateRequests
 * @apiGroup Certificates
 *
 * @api {delete} /me/certificates Unsubscribe to certificate
 * @apiName unsubscribe to certificate
 * @apiDescription Delete a relation of a certificate with the current user
 *
 * @apiParam (Body) {Integer} certificate_id (optional) Certficate's wanted to unsubscribe to id.
 * @apiParam (Body) {Array} certificate_ids (optional) Array with certficates's wanted to unsubscribe to ids.
 * @apiParam (Body) {String} certificate_code (optional) Certficate's wanted to unsubscribe to code.
 * @apiParam (Body) {Array} certificate_codes (optional) Array with certficates's wanted to unsubscribe to codes.
 *
 * @apiParam (Body) {Integer} user_id (optional) User who wanted to unsubscribe to id.
 * @apiParam (Body) {Array} user_ids (optional) Array with users whose wanted to unsubscribe to ids.
 *
 * @apiParamExample {json} Unsubscribe-Example:
 *     {
 *       "certificate_codes": [
 *              "PKKK",
 *              "QPFZ"
 *          ]
 *     }
 *
 * @apiSuccess {Array} data An array with the pairs (user, certificate) successfully unsubscribed.
 * @apiSuccess {Array} errors An array with errors.
 * @apiSuccessExample {json} Unsubscribe-Example-Response:
 *  {
 *     "data": [
 *         {
 *             "user": 1,
 *             "certificate": "PKKK"
 *         },
 *         {
 *             "user": 1,
 *             "certificate": "QPFZ"
 *         }
 *      ],
 *      "errors": [<error>, ...]
 * }
 *
 */

$router->delete('/me/certificates',[
    'as' => 'remove certificates',
    'middleware' => 'auth',
    'uses' => 'CertificateController@remove',
]);