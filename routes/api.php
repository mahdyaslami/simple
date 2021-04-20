<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$router = resolve(\Psr\Http\Server\RequestHandlerInterface::class)->getRouter();

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application. These
| routes are loaded by the nikic/fast-route package provided by 
| mahdyaslami/simple-fast-route plugin within vendor directory you
| can create your routes with with standards and options of league/route package.
|
| https://route.thephpleague.com/
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
| * String contain class fullname and public method name.
|       '\App\Controller\UserController@index'
*/

$router->get('/', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
});
