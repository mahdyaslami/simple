<?php

use Psr\Http\Message\ServerRequestInterface;
use Simplex\Contracts\ExceptionHandlerInterface;

$handler = resolve(ExceptionHandlerInterface::class);

$handler->render(Exception::class, function (\Throwable $e, ServerRequestInterface $request = null) {
    throw $e;
});
