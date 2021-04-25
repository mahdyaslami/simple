<?php

//
// Set env.php.
//
$_ENV = require_once('./env.php');

//
// Set app base path.
//
$_ENV['BASE_PATH'] = __DIR__;

//
// Bootstrap framework.
//
require_once './framework/bootstrap.php';

//
// Set routes.
//
require_once './routes/api.php';

//
// Set error handler.
//
require_once './app/Exceptions/Handler.php';
