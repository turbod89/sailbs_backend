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
 *                  {
 *                      id: "<certificate1 id. Required if not code provided>",
 *                      code: "<certificate1 code. Required if not id provided>",
 *                      max_errors: "<Integer. Optional>",
 *                      num_questions: "<Integer. Optional>"
 *                  },
 *                  ...
 *              ],
 *              "name": "Meteorology",
 *              "short_name": "Meteo",
 *              "description": "<Meteorology Subject Description>"
 *
 *          }
 *     }
 *
 * @apiParamExample {json} Multiple-subject-Example:
 *     {
 *       "subjects": [
 *          {<subject structure>},
 *          {<subject structure>},
 *          ...
 *       ]
 *     }
 *
 * @apiSuccess {Array} data An array with subjects created.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->post('/subjects',[
    'as' => 'post subjects',
    'middleware' => 'auth',
    'uses' => 'SubjectController@create',
]);


/**
 * @api {put} /subjects Put subjects
 * @apiName Update Subjects
 * @apiDescription Update subjects
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
 *                  {
 *                      id: "<certificate1 id. Required if not code provided>",
 *                      code: "<certificate1 code. Required if not id provided>",
 *                      max_errors: "<Integer. Optional>",
 *                      num_questions: "<Integer. Optional>"
 *                  },
 *                  ...
 *              ],
 *              "name": "Meteorology",
 *              "short_name": "Meteo",
 *              "description": "<Meteorology Subject Description>"
 *
 *          }
 *     }
 *
 * @apiParamExample {json} Multiple-subject-Example:
 *     {
 *       "subjects": [
 *          {<subject structure>},
 *          {<subject structure>},
 *          ...
 *       ]
 *     }
 *
 * @apiSuccess {Array} data An array with subjects updated.
 * @apiSuccess {Array} errors An array with errors.
 */

$router->put('/subjects',[
    'as' => 'put subjects',
    'middleware' => 'auth',
    'uses' => 'SubjectController@update',
]);


/**
 * @api {delete} /subjects Delete subjects
 * @apiName Delete Subjects
 * @apiDescription Delete subjects
 * @apiGroup Subjects
 *
 * @apiParam {Integer} subject_id (optional) Subject id to delete.
 * @apiParam {Array} subject_ids (optional) Array with subjects's ids.
 * @apiParam {String} subject_code (optional) Subject code to delete.
 * @apiParam {Array} subject_codes (optional) Array with subjects's ids.
 *
 * @apiParamExample {json} Simple-subject-Example:
 *     {
 *       "subject_id": 2
 *     }
 *
 * @apiParamExample {json} Multiple-subject-Example:
 *     {
 *       "subject_codes": [
 *          "PER",
 *          "PNB"
 *       ]
 *     }
 *
 * @apiSuccess {Array} data Null
 * @apiSuccess {Array} errors An array with errors.
 */

$router->delete('/subjects',[
    'as' => 'delete subjects',
    'middleware' => 'auth',
    'uses' => 'SubjectController@delete',
]);