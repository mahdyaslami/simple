<?php

//
// Current requset object
//
$request = new stdClass();

$request->uri = substr($_SERVER['REQUEST_URI'], strlen($env['baseUri']));
if (false !== $pos = strpos($request->uri, '?')) {
    $request->uri = substr($request->uri, 0, $pos);
}
$request->uri = rawurldecode($request->uri);

$request->method = $_SERVER['REQUEST_METHOD'];