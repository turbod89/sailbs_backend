<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    function __construct()
    {
    }

    public $errors = [];

    public function hasErrors() {
        return count($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }

    protected function addError($code = 1, $message = 'Unknown error.', $data = null) {
        $this->errors[] = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return $this;
    }

    protected function jsonData($data = null, $status = 200, $headers = [], $options = 0) {
        return response()->json([
            'data' => $data,
            'errors' => $this->getErrors(),
        ],$status,$headers,$options);
    }
}
