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

    public function read(Request $request, $exam_response_id = null) {

        if (empty($exam_response_id)) {

            $exam_responses = $request->user()->exam_responses;

            return $this->jsonData($exam_responses);
        }

        $exam_response = $request->user()->exam_responses->where('id',$exam_response_id);

        return $this->jsonData($exam_response->toArrayDetailed());


    }

}
