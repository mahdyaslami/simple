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
require_once './helpers.php';

//
// Create request factory for generating request.
//
container()->add(
    \Simplex\Contracts\RequestFactoryInterface::class,
    new \Simplex\Http\RequestFactory
);

//
// Create request handler for handling routes.
//
container()->add(
    \Psr\Http\Server\RequestHandlerInterface::class,
    new \Simplex\Http\RequestHandler(__DIR__ . '/cache/router.cache', !env('APP_DEBUG'))
);

require_once './../routes/api.php';

//
// Create exception handler.
//
container()->add(
    \Simplex\Contracts\ExceptionHandlerInterface::class,
    new \Simplex\Http\ExceptionHandler
);

require_once './../app/Exceptions/Handler.php';

//
// Create response emitter.
//
container()->add(
    \Simplex\Contracts\ResponseEmitterInterface::class,
    new \Simplex\Http\ResponseEmitter
);

//
// Create application.
//
return new \Simplex\Http\Application(
    resolve(\Simplex\Contracts\RequestFactoryInterface::class),
    resolve(\Psr\Http\Server\RequestHandlerInterface::class),
    resolve(\Simplex\Contracts\ExceptionHandlerInterface::class),
    resolve(\Simplex\Contracts\ResponseEmitterInterface::class)
);
