<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application. These
| routes are loaded by the nikic/fast-route package provided by 
| mahdyaslami/simple-fast-route plugin within vendor directory you
| can create your routes with with standards and options of fast route package.
|
| https://github.com/nikic/FastRoute
| https://github.com/mahdyaslami/simple-fast-route
|
| Note:
| * Anonymous functions does not supported as handler when cache is enabled.
| * Caching is enabled when APP_DEBUG environment variable is false.
| * Prevent using require or require_once function here.
|
| Acceptable Handlers:
| * Anonymous function - only in debug mode
| * Function name.
| * Array contain class fullname and a public method.
|       ['App\Controller\UserController', 'index']
*/

$router->addRoute('GET', '/', function () {
    echo 'Hello World!';
});
