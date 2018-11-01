<?php

/*
$router->get('/', function () use ($router) {
    return $router->app->version();
});
*/

$router->get('/',[
    'as' => 'root',
    'uses' => 'TestController@root',
]);
