<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    //

    public function getNewExam(Request $request, $certificate_code) {
        $certificate = Certificate::where(['code' => $certificate_code])->first();

        if (empty($certificate)) {
            $this->addError(1,'Invalid certificate code.');
            return $this->jsonData();
        }

        $exam = Exam::getUndoneExam($request->user(),$certificate);
        return $this->jsonData($exam);
    }

    public function correctExam(Request $request, $exam_id) {
        $exam = Exam::find($exam_id);

        if (empty($exam)) {
            $this->addError(1,'Invalid exam id.');
            return $this->jsonData();
        }

        // TODO: ensure this user can do this exam

        $request_data = null;
        if ($request->isJson()) {
            $request_data = $request->json()->all();
        } else {
            $request_data = $request->all();
        }

        $response = isset($request_data['response']) ? $request_data['response'] : [];

        $examResponse = Exam::correct($exam,$request->user(),$response);

        return $this->jsonData($examResponse);

    }
}
