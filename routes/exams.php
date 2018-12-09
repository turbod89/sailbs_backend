<?php


/*
 |------------------------------------------------
 | Exams
 |------------------------------------------------
 |
 |
 |
 */


/**
 * @apiDefine ExamRequests
 * @apiHeader (Headers) {String} Authorization Bearer Auth token. Obtained in call <em>Get Auth Token</em>.
 * @apiSuccess {Array} errors An array with errors.
 */

/**
 * @apiUse ExamRequests
 * @apiGroup Exams
 *
 * @api {get} /me/certificate_code/exam Get new exam
 * @apiName Get new exam
 * @apiDescription Get a new exam for an user and a certificate. If it exists an exam of that certificate without an examResponse from that user, it will be returned. If not, a new exam will be generated.
 *
 * @apiSuccessExample {json} Success-Response:
 *      HTTP 1.1 200 OK
 * {
 *     "data": {
 *         "id": 4,
 *         "certificate_id": 2,
 *         "deleted": 0,
 *         "created_at": "2018-11-19 16:28:38",
 *         "updated_at": "2018-11-19 16:28:38",
 *         "deleted_at": null,
 *         "name": "Test aleatorio de Título de Patrón de Embarcaciones de Recreo.",
 *         "short_name": "Test de Patrón de Embarcaciones de Recreo.",
 *         "description": "Este es un test de Título de Patrón de Embarcaciones de Recreo generado automáticamente a fecha 2018-11-19 16:28:38.",
 *         "questions": [
 *             {
 *                 "id": 8,
 *                 "uuid": "227993e0-ec18-11e8-935c-1dcb29778d82",
 *                 "subject_id": 1,
 *                 "deleted": 0,
 *                 "created_at": "2018-11-19 16:28:23",
 *                 "updated_at": "2018-11-19 16:28:23",
 *                 "deleted_at": null,
 *                 "statement": "Pregunta de Navegación número 8.",
 *                 "pivot": {
 *                     "exam_id": 4,
 *                     "question_id": 8
 *                 },
 *                 "answers": [
 *                     {
 *                         "id": 29,
 *                         "uuid": "2621d690-ec18-11e8-b71a-df84a7fa7f5b",
 *                         "question_id": 8,
 *                         "position": 0,
 *                         "deleted": 0,
 *                         "created_at": "2018-11-19 16:28:29",
 *                         "updated_at": "2018-11-19 16:28:29",
 *                         "deleted_at": null,
 *                         "statement": "Respuesta incorrecta a la pregunta 'Pregunta de Navegación número 8.' número 1."
 *                     },
 *                     ...
 *                 ]
 *             },
 *             ...
 *         ]
 *     },
 *     "errors": []
 * }
 *
 * @apiSuccess {Array} data Exam data.
 */

$router->get('/me/{certificate_code}/exam',[
    'as' => 'get new exam',
    'middleware' => 'auth',
    'uses' => 'ExamController@getNewExam',
]);

/**
 * @apiUse ExamRequests
 * @apiGroup Exams
 *
 * @api {get} /exams/exam_id Get an exam by id
 * @apiName Get exam
 * @apiDescription Get an exam by id
 *
 * @apiSuccessExample {json} Success-Response:
 *      HTTP 1.1 200 OK
 * {
 *     "data": {
 *         "id": 4,
 *         "certificate_id": 2,
 *         "deleted": 0,
 *         "created_at": "2018-11-19 16:28:38",
 *         "updated_at": "2018-11-19 16:28:38",
 *         "deleted_at": null,
 *         "name": "Test aleatorio de Título de Patrón de Embarcaciones de Recreo.",
 *         "short_name": "Test de Patrón de Embarcaciones de Recreo.",
 *         "description": "Este es un test de Título de Patrón de Embarcaciones de Recreo generado automáticamente a fecha 2018-11-19 16:28:38.",
 *         "questions": [
 *             {
 *                 "id": 8,
 *                 "uuid": "227993e0-ec18-11e8-935c-1dcb29778d82",
 *                 "subject_id": 1,
 *                 "deleted": 0,
 *                 "created_at": "2018-11-19 16:28:23",
 *                 "updated_at": "2018-11-19 16:28:23",
 *                 "deleted_at": null,
 *                 "statement": "Pregunta de Navegación número 8.",
 *                 "pivot": {
 *                     "exam_id": 4,
 *                     "question_id": 8
 *                 },
 *                 "answers": [
 *                     {
 *                         "id": 29,
 *                         "uuid": "2621d690-ec18-11e8-b71a-df84a7fa7f5b",
 *                         "question_id": 8,
 *                         "position": 0,
 *                         "deleted": 0,
 *                         "created_at": "2018-11-19 16:28:29",
 *                         "updated_at": "2018-11-19 16:28:29",
 *                         "deleted_at": null,
 *                         "statement": "Respuesta incorrecta a la pregunta 'Pregunta de Navegación número 8.' número 1."
 *                     },
 *                     ...
 *                 ]
 *             },
 *             ...
 *         ]
 *     },
 *     "errors": []
 * }
 *
 * @apiSuccess {Array} data Exam data.
 */

$router->get('/exams/{exam_id}',[
    'as' => 'get exam',
    'middleware' => 'auth',
    'uses' => 'ExamController@read',
]);


/**
 * @apiUse ExamRequests
 * @apiGroup Exams
 *
 * @api {get} /me/exams Get exams response
 * @apiName Get exams response
 * @apiDescription Get done exam history
 * @apiGroup Exams
 *
 *
 * @apiSuccessExample {json} Success-Get-Exams-Responses-Response:
 *      HTTP 1.1 200 OK
 * {
 *     "data": [
 *         {
 *             "id": 1,
 *             "started_at": "-0001-11-30 00:00:00",
 *             "finished_at": "2018-12-02 16:42:11",
 *             "corrected_at": "2018-12-02 16:42:12",
 *             "user_id": 1,
 *             "exam_id": 1,
 *             "deleted": 0,
 *             "created_at": "2018-12-02 16:42:11",
 *             "updated_at": "2018-12-02 16:42:12",
 *             "deleted_at": null,
 *             "is_passed": 1,
 *             "certificate_code": "PDSS",
 *             "summary": {
 *                 "exam_response_id": 1,
 *                 "num_questions": 19,
 *                 "num_answered": 19,
 *                 "num_correct": 6,
 *                 "num_errors": 13,
 *                 "max_errors": 99999,
 *                 "exam_passed": 1
 *             },
 *             "subject_summary": [
 *                 {
 *                     "subject_id": 1,
 *                     "num_questions": 3,
 *                     "num_answered": 3,
 *                     "num_correct": 1,
 *                     "num_errors": 2,
 *                     "max_errors": 2,
 *                     "subject_passed": 1
 *                 },
 *                 ...
 *             ]
 *         },
 *         ...
 *     ],
 *     "errors": []
 * }
 *
 * @apiSuccess {Array} data Exam data.
 */

$router->get('/me/exams',[
    'as' => 'get exams history',
    'middleware' => 'auth',
    'uses' => 'ExamResponseController@read',
]);

/**
 * @apiUse ExamRequests
 * @apiGroup Exams
 *
 * @api {get} /me/exams/exam_response_id Get exam response
 * @apiName Get exam response
 * @apiDescription Get done exam
 * @apiGroup Exams
 *
 *
 * @apiSuccessExample {json} Success-Get-Exams-Responses-Response:
 *      HTTP 1.1 200 OK
 * {
 *     "data": {
 *        "id": 1,
 *        "started_at": "-0001-11-30 00:00:00",
 *        "finished_at": "2018-12-02 16:42:11",
 *        "corrected_at": "2018-12-02 16:42:12",
 *        "user_id": 1,
 *        "exam_id": 1,
 *        "deleted": 0,
 *        "created_at": "2018-12-02 16:42:11",
 *        "updated_at": "2018-12-02 16:42:12",
 *        "deleted_at": null,
 *        "is_passed": 1,
 *        "certificate_code": "PDSS",
 *        "summary": {
 *            "exam_response_id": 1,
 *            "num_questions": 19,
 *            "num_answered": 19,
 *            "num_correct": 6,
 *            "num_errors": 13,
 *            "max_errors": 99999,
 *            "exam_passed": 1
 *        },
 *        "subject_summary": [
 *            {
 *                "subject_id": 1,
 *                "num_questions": 3,
 *                "num_answered": 3,
 *                "num_correct": 1,
 *                "num_errors": 2,
 *                "max_errors": 2,
 *                "subject_passed": 1
 *            },
 *            ...
 *        ]
 *     },
 *     "errors": []
 * }
 *
 * @apiSuccess {Array} data Exam data.
 */

$router->get('/me/exams/{exam_response_id}',[
    'as' => 'get exam response',
    'middleware' => 'auth',
    'uses' => 'ExamResponseController@read',
]);

/**
 * @apiUse ExamRequests
 * @apiGroup Exams
 *
 * @api {post} /me/exams/exam_id Correct an exam
 * @apiName Correct exam
 * @apiDescription Correct an exam. Returns a exam response
 * @apiGroup Exams
 *
 * @apiParamExample {json} Exam-correct-Example:
 *     {
 *       "response": [
 *              {
 *                  answer_uuid: <answer uuid>
 *              },
 *              ...
 *
 *          ]
 *     }
 *
 * @apiSuccess {Array} data Exam data.
 */

$router->post('/me/exams/{exam_id}',[
    'as' => 'correct exam',
    'middleware' => 'auth',
    'uses' => 'ExamController@correctExam',
]);