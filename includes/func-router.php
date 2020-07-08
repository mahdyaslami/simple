<?php

/**
 * Change a routes array to a regex pattern.
 * 
 * @param array $routes Array of route items
 */
function routesArrayToPattern($routes)
{
    //
    // For each item in routes array run routItemToPattern function and get
    // corresponding pattern and concat them with `|` (or) in regex.
    //
    // Finally remove first `|` and return prepared pattern
    //
    $pattern = array_reduce(array_keys($routes), function ($carry, $item) use ($routes) {
        return $carry . '|' . routeItemToPattern($routes[$item], $item);
    }, '');
    $pattern = substr($pattern, 1);

    return '/(' . str_replace('/', '\/', $pattern) . ')/';
}

/**
 * Get regex pattern for a route item.
 * 
 * @param array $route A route item that defined in configs/routes.php
 * @param int $index Index of current route item in routes array.
 */
function routeItemToPattern($route, $index)
{
    //
    // Check if there is any `param` entry in route item.
    //
    if (isset($route['params'])) {
        //
        // Get param keys and map them into string like `{paramter-name}` for
        // use them as array search in str_replace.
        //
        $array_keys = array_keys($route['params']);
        $arraySearch = array_map(function ($value) {
            return '{' . $value . '}';
        }, $array_keys);

        //
        // Map paramters regex pattern to a string capture regex pattern and generate
        // an array replace corresponding to array search.
        //
        $arrayReplace = array_map(function ($value, $key) use ($index) {
            return '(?<' . $key . $index . '>' . $value . ')';
        }, array_values($route['params']), $array_keys);

        //
        // Prepare route item pattern and return them.
        //
        return '(' . $route['method'] . ')* ' . str_replace($arraySearch, $arrayReplace, $route['path']) . '$(*:' . $index . ')';
    }

    //
    // Return pattern of route that does not have any parameter.
    //
    return '(' . $route['method'] . ')* ' . $route['path'] . '$(*:' . $index . ')';
}

function routeRequest($routes, $request)
{
    $input = $request->method . ' ' . $request->uri;
    preg_match(routesArrayToPattern($routes), $input, $output);
    print_r($output);
}
