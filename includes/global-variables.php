<?php

//
// If framework is in sub-directory add directories sequence here.
//
// http://www.google.com/path/to/site/ -> baseUri = /path/to/site
//
$baseUri = '/ssfw';

//
// Current requset object
//
$request = new stdClass();
$request->uri = substr($_SERVER['REQUEST_URI'], strlen($baseUri));
$request->method = $_SERVER['REQUEST_METHOD'];