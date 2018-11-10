<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class SubjectController extends BaseController
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


    public function read(Request $request) {

        if ($request->user()->can('get',Subject::class)) {

            $subjects = Subject::all();

            return $this->jsonData($subjects);
        } else {
            $this->addError(1,'Not allowed.');
        }

        return $this->jsonData();

    }

    public function create(Request $request) {

        if ($request->user()->can('create',Subject::class)) {

            $request_data = null;
            if ($request->isJson()) {
                $request_data = $request->json()->all();
            } else {
                $request_data = $request->all();
            }

            $subject_data = isset($request_data['subject']) ? $request_data['subject'] : null;
            $subjects_data = isset($request_data['subjects']) ? $request_data['subjects'] : [];

            if (!empty($subject_data)) {
                $subjects_data[] = $subject_data;
            }

            $data = [];

            foreach ($subjects_data as $subject_data) {

                if (!isset($subject_data['code'])) {
                    $this->addError(1,'Invalid code for subject.',$request_data);
                } else {

                    try {

                        $subject = new Subject();
                        $subject->code = $subject_data['code'];
                        $subject->name = isset($subject_data['name']) ? $subject_data['name'] : '';
                        $subject->short_name = isset($subject_data['short_name']) ? $subject_data['short_name']  : '';
                        $subject->description = isset($subject_data['description']) ? $subject_data['description']  : '';

                        $subject->save();
                        $data[] = $subject->toArray();

                    } catch (\Exception $e) {
                        $this->addError(2, $e->getMessage());
                    }
                }
            }


            return $this->jsonData($data);
        } else {
            $this->addError(1,'Not allowed to create subjects.');
        }

        return $this->jsonData();
    }

}
