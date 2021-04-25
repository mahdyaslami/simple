<?php

use Psr\Http\Server\RequestHandlerInterface;
use Simplex\Contracts\ExceptionHandlerInterface;
use Simplex\Contracts\RequestFactoryInterface;
use Simplex\Contracts\ResponseEmitterInterface;
use Simplex\Http\ExceptionHandler;
use Simplex\Http\RequestFactory;
use Simplex\Http\RequestHandler;
use Simplex\Http\ResponseEmitter;

//
// Set env.php.
//
$_ENV = require_once('./../env.php');

//
// Set app base path.
//
$_ENV['BASE_PATH'] = dirname(__DIR__);

//
// Add extended helpers.
//
require_once __DIR__ . '/helpers.php';

//
// Create request factory for generating request.
//
container()->singleton(
    RequestFactoryInterface::class,
    new RequestFactory
);

//
// Create request handler for handling routes.
//
container()->singleton(
    RequestHandlerInterface::class,
    new RequestHandler(__DIR__ . '/cache/router.cache', !env('APP_DEBUG'))
);

require_once './../routes/api.php';

//
// Create exception handler.
//
container()->singleton(
    ExceptionHandlerInterface::class,
    new ExceptionHandler
);

require_once './../app/Exceptions/Handler.php';

//
// Create response emitter.
//
container()->singleton(
    ResponseEmitterInterface::class,
    new ResponseEmitter
);

//
// Create application.
//
container()->singleton(
    'app',
    new \Simplex\Http\Application(
        resolve(RequestFactoryInterface::class),
        resolve(RequestHandlerInterface::class),
        resolve(ExceptionHandlerInterface::class),
        resolve(ResponseEmitterInterface::class)
    )
);
