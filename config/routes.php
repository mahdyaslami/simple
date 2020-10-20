<?php

$router->addRoute('GET', '/hello-world', function() {
    require_once(base_path('/src/helloworld.php'));
});

$router->addGroup('/users', function (FastRoute\RouteCollector $group) {
    $group->addRoute('GET', '/{id:\d+}[/{name}]', function($parameters) {
        print_r($parameters);
    });
    $group->addRoute('POST', '/create', function() {
        echo 'create';
    });
});
