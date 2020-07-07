<?php

$routes = [
    [
        'method' => 'GET',
        'path' => '/users'
    ],
    [
        'method' => 'POST',
        'path' => '/users'
    ],
    [
        'method' => 'GET',
        'path' => '/users/{id}',
        'params' => [
            'id' => '\d+'
        ]
    ],
    [
        'method' => 'POST',
        'path' => '/users/{id}',
        'params' => [
            'id' => '\d+'
        ]
    ],
    [
        'method' => 'POST',
        'path' => '/{lang}/users/{id}',
        'params' => [
            'lang' => 'en|fa',
            'id' => '\d+'
        ]
    ],
];
