<?php

use Psr\Http\Message\ServerRequestInterface;

$handler = resolve('error-handler');

$handler->render(Exception::class, function (\Throwable $e, ServerRequestInterface $request = null) {
    throw $e;
});
