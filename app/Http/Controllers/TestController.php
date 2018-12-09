<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


/*
 |------------------------------------------------
 | Test
 |------------------------------------------------
 |
 | Git will not keep track of this file from now on.
 |
 | Feel free to modify it all as you want to make
 | your tests.
 |
 | Notice that Test Routes will also remain untracked.
 |
 | More info: https://stackoverflow.com/questions/3319479/can-i-git-commit-a-file-and-ignore-its-content-changes
 |
 */

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
