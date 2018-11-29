<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamResponseController extends BaseController
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

    public function read(Request $request) {

        $exam_responses = $request->user()->examResponses;

        return $this->jsonData($exam_responses);

    }

}
