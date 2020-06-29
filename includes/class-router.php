<?php

function arrayToPattern($routes)
{
    $pattern = '(' . $routes[0]['method'] . ')* ' . $routes[0]['url'] . '$(*:0)';
    for ($i = 1; $i < count($routes); $i++) {
        $pattern .= '|(' . $routes[$i]['method'] . ')* ' . $routes[$i]['url'] . '$(*:' . $i . ')';
    }
        
    return '/(' . $pattern . ')/';
}
