<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version(
    ['v1'],
    function (Router $api){
        $api->get('/',fn()=>['message' => 'Hello World!']);
    }
);
