<?php

require_once(__DIR__ . '/includes/global-variables.php');
require_once(__DIR__ . '/includes/class-router.php');

try {
    require_once(__DIR__ . '/routes.php');
} catch (Throwable $e) {
    http_response_code($e->getCode());
    throw $e;
}