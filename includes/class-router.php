<?php

function routesArrayToPattern($routes)
{
    $pattern = routeItemToPattern($routes[0], 0);
    for ($i = 1; $i < count($routes); $i++) {
        $pattern .= '|' . routeItemToPattern($routes[$i], $i);
    }

    return '/(' . $pattern . ')/';
}

function routeItemToPattern($route, $index)
{
    if (isset($route['params'])) {
        $array_keys = array_keys($route['params']);
        $arraySearch = array_map(function ($value) {
            return '{' . $value . '}';
        }, $array_keys);

        $arrayReplace = array_map(function ($value, $key) use ($index) {
            return '(?<' . $key . $index . '>' . $value . ')';
        }, array_values($route['params']), $array_keys);
        return '(' . $route['method'] . ')* ' . str_replace($arraySearch, $arrayReplace, $route['url']) . '$(*:' . $index . ')';
    }

    return '(' . $route['method'] . ')* ' . $route['url'] . '$(*:' . $index . ')';
}
