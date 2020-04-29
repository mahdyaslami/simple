<?php

function checkUri($pattern)
{
    global $requestUri;

    $pattern = preg_replace('/{num:\w+}/', '(\d+)', $pattern);
    $pattern = preg_replace('/{\w+}/', '(\w+)', $pattern);
    $pattern = str_replace('/', '\/', $pattern);

    $matchs = [];
    if (preg_match('/' . $pattern . '/', $requestUri, $matchs) !== 1) {
        return false;
    }

    if (isset($matchs[0]) === false || $matchs[0] !== $requestUri) {
        return false;
    }
    
    return true;
}