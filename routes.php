<?php

$router = new Router();

if ($router->get('/users')) {
    echo 'users';
} else if ($router->post('/users/{num:id}')) {
    require_once(__DIR__ . '/src/helloworld.php');
} 

//
// Error handling
//

if ($router->getAcceptedCount() > 0) {
    // Silence.
} else if ($router->getMatchsCount() > 0) {
    throw new Exception('Method not allowed.', 405);
} else {
    throw new Exception('Not found', 404);
}
