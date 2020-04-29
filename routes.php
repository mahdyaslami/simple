<?php

if (checkUri('/users')) {
    echo 'users';
} else if (checkUri('/users/{num:id}')) {
    require_once(__DIR__ . '/src/helloworld.php');
}
