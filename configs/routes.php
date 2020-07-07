<?php
/**
 * An Route Item:
 *  [
 *      'method' => GET, POST, DELETE, ... have to be uppercase.
 *      'path' => 
 *              Path of url and have to start with `/` like `/users`.
 *              Parameters have to be in `{}` like `/users/{id}`
 *              Parameters name have to be in snake case format like `start-date`.
 *      'params' => 
 *              Array of parameters that used in path. see following array:
 *                  [
 *          'param-name' => 'regex-exp without parenthesis `()`'
 *      ]
 *  ]
 */

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
