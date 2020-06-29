<?php

$routes = [
    [
        'method' => 'GET',
        'url' => '/users'
    ],
    [
        'method' => 'POST',
        'url' => '/users'
    ],
    [
        'method' => 'GET',
        'url' => '/users/(\d+)'
    ],
    [
        'method' => 'POST',
        'url' => '/users/(\d+)'
    ],
    [
        'method' => 'POST',
        'url' => '/(en|fa)/users/(\d+)'
    ],
];
