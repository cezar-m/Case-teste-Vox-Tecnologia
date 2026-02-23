<?php

protected $routeMiddleware = [
    // outros middlewares...
    'auth' => \App\Http\Middleware\Authenticate::class,
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
];
