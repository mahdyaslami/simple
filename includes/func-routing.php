<?php

function checkUri($method, $pattern)
{
    global $request;

    $pattern = preg_replace('/{num:\w+}/', '(\d+)', $pattern);
    $pattern = preg_replace('/{\w+}/', '(\w+)', $pattern);
    $pattern = str_replace('/', '\/', $pattern);

    $matchs = [];
    if (preg_match('/' . $pattern . '/', $request->uri, $matchs) !== 1) {
        return false;
    }

    if (isset($matchs[0]) === false 
        || $matchs[0] !== $request->uri) {
        return false;
    }

    if (strtoupper($method) !== $request->method) {
        throw new Exception('Method not allowed.', 405);
    }
    
    return true;
}