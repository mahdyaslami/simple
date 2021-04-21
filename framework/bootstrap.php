<?php

//
// Set env.php.
//
$_ENV = require_once('./../env.php');

//
// Set app base path.
//
$_ENV['BASE_PATH'] = dirname(__DIR__);

//
// Add helpers.
//
require_once __DIR__ . '/helpers.php';

//
// Create request factory for generating request.
//
container()->add(
    'request-factory',
    new \Simplex\Http\RequestFactory
);

//
// Create request handler for handling routes.
//
container()->add(
    'request-handler',
    new \Simplex\Http\RequestHandler(__DIR__ . '/cache/router.cache', !env('APP_DEBUG'))
);

require_once './../routes/api.php';

//
// Create exception handler.
//
container()->add(
    'error-handler',
    new \Simplex\Http\ExceptionHandler
);

require_once './../app/Exceptions/Handler.php';

//
// Create response emitter.
//
container()->add(
    'response-emitter',
    new \Simplex\Http\ResponseEmitter
);

//
// Create application.
//
container()->add(
    'app',
    new \Simplex\Http\Application(
        resolve('request-factory'),
        resolve('request-handler'),
        resolve('error-handler'),
        resolve('response-emitter')
    )
);
