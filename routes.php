<?php

if (checkUri('get', '/users')) {
    echo 'users';
} else if (checkUri('post', '/users/{num:id}')) {
    require_once(__DIR__ . '/src/helloworld.php');
} else {
    throw new Exception('Not found', 404);
}
