<?php

require_once('includes/global-variables.php');
require_once('vendor/autoload.php');

try {
    $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
        require_once('configs/routes.php');
    });

    $routeInfo = $dispatcher->dispatch($request->method, $request->uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            throw new Exception('Not found.', 404);
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            // $allowedMethods = $routeInfo[1];
            throw new Exception('Method not allowed.', 405);
            break;
        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            $handler($vars);
            break;
    }
} catch (Throwable $e) {
    http_response_code($e->getCode());
    throw $e;
}
