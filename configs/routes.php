<?php

$router->addRoute('GET', '/hello-world', function($parameters) {
    require_once(__DIR__ . '/src/helloworld.php');
});

$router->addGroup('/users', function (FastRoute\RouteCollector $group) {
    $group->addRoute('GET', '/{id:\d+}', function() {
        echo 'an item';
    });
    $group->addRoute('POST', '/create', function() {
        echo 'create';
    });
});
