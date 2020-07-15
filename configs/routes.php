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
 *          'id' => '\d+',
 *          'param-name' => 'regex-exp without parenthesis `()`'
 *      ]
 *      'callbacks' => 
 *              Array of functions that you want to invoke after each other.
 *              We always send two paramters to functions $request, $args.
 *                  $request: Contain current request.
 *                  $args: Contain path paramters value for example if path is
 *                      `/users/10` and pattern is `/users/{id}` you can get id 
 *                      with handle `$args['id']`.
 *  ]
 * An Route Group:
 *  [
 *      'path' => 
 *              Path of url and have to start with `/` like `/users`.
 *              Parameters have to be in `{}` like `/users/{id}`
 *              Parameters name have to be in snake case format like `start-date`.
 *      'params' => 
 *              Array of parameters that used in path. avoid repeating 
 *              parameters in children. see following array:
 *                  [
 *          'id' => '\d+',
 *          'param-name' => 'regex-exp without parenthesis `()`'
 *      ]
 *      'beforeCallbacks' => Execute before children callbacks.
 *      'afterCallbacks' => Execute after children callbacks.
 *              Array of functions that you want to invoke after each other.
 *              We always send two paramters to functions $request, $args.
 *                  $request: Contain current request.
 *                  $args: Contain path paramters value for example if path is
 *                      `/users/10` and pattern is `/users/{id}` you can get id 
 *                      with handle `$args['id']`.
 *       'children' =>
 *              Contain route items with current route group prefix.
 *  ]
 */

$routes = [
    [
        'method' => 'GET',
        'path' => '/users',
        'callbacks' => [
            function () {
                echo 'Hello';
            },
            function ($request) {
                echo ' World! ' . $request->uri;
            }
        ]
    ],
    [
        'method' => 'POST',
        'path' => '/users',
        'callbacks' => []
    ],
    [
        'method' => 'GET',
        'path' => '/users/{id}',
        'params' => [
            'id' => '\d+'
        ],
        'callbacks' => [
            function () {
                echo 'Hello';
            },
            function ($request, $args) {
                echo ' World! ' . $args['id'];
            }
        ]
    ],
    [
        'method' => 'POST',
        'path' => '/users/{id}',
        'params' => [
            'id' => '\d+'
        ],
        'callbacks' => []
    ],
    [
        'method' => 'POST',
        'path' => '/{lang}/users/{id}',
        'params' => [
            'lang' => 'en|fa',
            'id' => '\d+'
        ],
        'callbacks' => []
    ],
    [
        'path' => '/colors',
        'beforeCallbacks' => [
            function () {
                echo 'before ';
            }
        ],
        'afterCallbacks' => [
            function ($request) {
                echo ' after';
            }
        ],
        'children' => [
            [
                'method' => 'GET',
                'path' => '',
                'callbacks' => [
                    function () {
                        echo 'Hello';
                    },
                    function ($request) {
                        echo ' World! ' . $request->uri;
                    }
                ]
            ],
            [
                'method' => 'POST',
                'path' => '',
                'callbacks' => []
            ],
            [
                'method' => 'GET',
                'path' => '/{id}',
                'params' => [
                    'id' => '\d+'
                ],
                'callbacks' => [
                    function () {
                        echo 'Hello';
                    },
                    function ($request, $args) {
                        echo ' World! ' . $args['id'];
                    }
                ]
            ],
            [
                'method' => 'POST',
                'path' => '/{id}',
                'params' => [
                    'id' => '\d+'
                ],
                'callbacks' => []
            ]
        ]
    ]
];
