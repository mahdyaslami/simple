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
        'url' => '/users/{id}',
        'params' => [
            'id' => '\d+'
        ]
    ],
    [
        'method' => 'POST',
        'url' => '/users/{id}',
        'params' => [
            'id' => '\d+'
        ]
    ],
    [
        'method' => 'POST',
        'url' => '/{lang}/users/{id}',
        'params' => [
            'lang' => 'en|fa',
            'id' => '\d+'
        ]
    ],
];
