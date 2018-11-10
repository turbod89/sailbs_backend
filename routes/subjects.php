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
 * @api {get} /subjects Get subjects
 * @apiName Read Subjects
 * @apiDescription Get all subjects
 * @apiGroup Subjects
 *
 * @apiSuccess {Array} data An array with all subjects.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->get('/subjects',[
    'as' => 'get subjects',
    'middleware' => 'auth',
    'uses' => 'SubjectController@read',
]);


/**
 * @api {post} /subjects Post subjects
 * @apiName Create Subjects
 * @apiDescription Create subjects
 * @apiGroup Subjects
 *
 * @apiParam {Subject} subject (conditional) Subject data to create. Fields as shown in example. Obligatory if not <em>subjects</em> is provided.
 * @apiParam {Array} subjects (conditional) Array with subjects's data. Obligatory if not <em>subject</em> is provided.
 *
 * @apiParamExample {json} Simple-subject-Example:
 *     {
 *       "subject": {
 *              "code": "meteo",
 *              "certificates": [
 *                  "<certificate1 code>",
 *                  "<certificate2 code>",
 *                  ...
 *              ],
 *              "name": "Meteorology",
 *              "short_name": "Meteo",
 *              "description": "<Meteorology Subject Description>"
 *
 *          }
 *     }

 * @apiParamExample {json} Multiple-subject-Example:
 *     {
 *       "subjects": [
 *          {<subject structure>},
 *          {<subject structure>},
 *          ...
 *       ]
 *     }
 *
 * @apiSuccess {Array} data An array with all subjects.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->post('/subjects',[
    'as' => 'post subjects',
    'middleware' => 'auth',
    'uses' => 'SubjectController@create',
]);