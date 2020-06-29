<?php

require_once(__DIR__ . '/includes/global-variables.php');
require_once(__DIR__ . '/includes/class-router.php');
require_once(__DIR__ . '/configs/routes.php');

try {
    echo htmlspecialchars(arrayToPattern($routes));

} catch (Throwable $e) {
    http_response_code($e->getCode());
    throw $e;
}