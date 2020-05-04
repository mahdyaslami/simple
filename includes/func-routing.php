<?php

/**
 * Check if request uri match with pattern.
 * 
 * @param string $method HTTP method: GET, POST, PUT, PATCH, DELETE, ...
 * @param string $pattern Contain pattern you want to match with request uri.
 *  number: /users/{num:id}
 *  string: /news/today/{subtitle}
 * 
 * @return bool if request match return true else return false.
 * 
 * @throws \Exception (Method not allowed.) When request match and method does
 *  match.
 */
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