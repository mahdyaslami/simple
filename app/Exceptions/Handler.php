<?php

use Psr\Http\Message\ServerRequestInterface;

$handler = resolve(\Simplex\Contracts\ExceptionHandlerInterface::class);

$handler->render(Exception::class, function (\Throwable $e, ServerRequestInterface $request = null) {
    throw $e;
});
