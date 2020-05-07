<?php

$router = new Router();

if ($router->get('/hello-world')) {
    require_once(__DIR__ . '/src/helloworld.php');
}

if ($router->addBaseUri('/users')) {
    if ($router->get('/{num:id}')) {
        die('an item.');
    } else if ($router->post('/create')) {
        die('create');
    }
    $router->resetBaseUri();
}

//
// Routing errors
//

if ($router->getAcceptedCount() > 0) {
    // Silence.
} else if ($router->getMatchsCount() > 0) {
    throw new Exception('Method not allowed.', 405);
} else {
    throw new Exception('Not found.', 404);
}
