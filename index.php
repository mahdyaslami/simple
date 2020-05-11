<?php

require_once('includes/global-variables.php');
require_once('includes/class-router.php');
require_once('vendor/autoload.php');

try {
    require_once('routes.php');
} catch (Throwable $e) {
    http_response_code($e->getCode());
    throw $e;
}