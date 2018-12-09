<?php

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
 | Notice that TestController will also remain untracked.
 |
 | More info: https://stackoverflow.com/questions/3319479/can-i-git-commit-a-file-and-ignore-its-content-changes
 |
 */

$router->get('/',[
    'as' => 'root',
    'uses' => 'TestController@root',
]);
