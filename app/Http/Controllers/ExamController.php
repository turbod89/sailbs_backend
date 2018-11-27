<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Exam;
use Illuminate\Http\Request;

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
}
