<?php

use App\Http\Controllers\ResourcesController;
use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version(
    ['v1'],
    function (Router $api) {
        $api->get('/', fn() => ['message' => 'Hello World!']);
        $api->resource('resources', ResourcesController::class, ['index', 'show', 'store', 'update', 'destroy']);
    }
);
