<?php

require_once(__DIR__ . '/includes/global-variables.php');
require_once(__DIR__ . '/includes/func-router.php');
require_once(__DIR__ . '/configs/routes.php');
require_once('vendor/autoload.php');

try {
    routeRequest($routes, $request);
} catch (Throwable $e) {
    http_response_code($e->getCode());
    throw $e;
}
