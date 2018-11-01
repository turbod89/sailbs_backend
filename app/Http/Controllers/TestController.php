<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class TestController extends BaseController
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

    public function root(Request $request) {
        return app()->version();
    }
}
