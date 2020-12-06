<?php

require_once __DIR__ . '/../vendor/autoload.php';

//
// Set app base path.
//
$GLOBALS['BASE_PATH'] = dirname(__DIR__);

//
// Register environment variables.
//
\Simple\Env\Provider::create(
    base_path('env.php')
)->register();

//
// Register router.
//
\Simple\FastRoute\Provider::create(
    [\App\Routes\Router::class, 'boot']
)->withErrorHandler(
    [\App\Exceptions\Handler::class, 'register']
)->register();