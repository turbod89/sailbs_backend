<?php


/*
 |------------------------------------------------
 | Tokens
 |------------------------------------------------
 |
 |
 |
 */

/**
 * @apiDefine AuthToken
 * @apiHeader (Authentication) {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
 */

/**
 * @apiDefine StandardResponse
 * @apiSuccess (Standard) {Array} errors An array with errors.
 */

/**
 * @api {get} /tokens Get Auth Token
 * @apiName GetToken
 * @apiGroup Token
 *
 * @apiHeader {String} api-token Your application token.
 *
 * @apiUse StandardResponse
 * @apiSuccessExample {json} Success-Example:
 *  {
 *    "data": {
 *        "auth_token": {
 *            "value": "8990578c5ad9458c3df6456e84e6c0d7",
 *            "expire_at": {
 *                "date": "2018-12-31 23:59:59.000000",
 *                "timezone_type": 3,
 *                "timezone": "UTC"
 *            }
 *        }
 *    },
 *    "errors": []
 * }
 */

$router->get('/tokens',[
    'as' => 'getToken',
    'uses' => 'TokenController@getAuthToken',
]);