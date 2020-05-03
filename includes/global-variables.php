<?php

$baseUri = '/ssfw';

$request = new stdClass();
$request->uri = substr($_SERVER['REQUEST_URI'], strlen($baseUri));
$request->method = $_SERVER['REQUEST_METHOD'];