<?php

/**
 * Map every route group in routes to route items
 * 
 * @param array $routes Array contains route items and route groups.
 * 
 * @return array Array contains route items only.
 */
function mapGroupedRoutes($routes)
{
    $result = [];
    //
    // Iterate all $routes item and map route group items to route items.
    //
    array_walk($routes, function ($item) use (&$result) {
        if (isset($item['children'])) {
            mapRouteGroupToRouteItems($item, $result);
        } else {
            array_push($result, $item);
        }
    });
    return $result;
}

/**
 * Map a route group to route items.
 * 
 * @param array $group A route group that defined in configs/routes.php
 * @param array $routes Refer to an array to which you want to add route items.
 */
function mapRouteGroupToRouteItems($group, &$routes)
{
    //
    // Iterate for each children items.
    //
    array_walk($group['children'], function ($item) use (&$routes, $group) {
        //
        // Concat group path before route item path.
        //
        $item['path'] = $group['path'] . $item['path'];

        //
        // Merge callbacks.
        //
        $item['callbacks'] = array_merge($group['beforeCallbacks'], $item['callbacks'], $group['afterCallbacks']);

        //
        // Push new route item into $routes.
        //
        array_push($routes, $item);
    });
}

/**
 * Change a routes array to a regex pattern.
 * 
 * @param array $routes Array of route items.
 * 
 * @return string Regex pattern of all routes.
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
 * 
 * @return string Regex pattern of $route.
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

/**
 * Find related route to current request path and invoke it's callbacks.
 * 
 * @param array $routes Array of route items. (for route item details see configs/routes.php)
 * @param object $request Global request object. (for request object details see includes/global-variables.php)
 * 
 * @throws \Exception Method not allowed, Not found, Server error (callbacks is not setted.)
 */
function routeRequest($routes, $request)
{
    //
    // Prepare input for regex matching and do matching.
    //
    $input = $request->method . ' ' . $request->uri;
    $routes = mapGroupedRoutes($routes);
    preg_match(routesArrayToPattern($routes), $input, $output);

    //
    // If matching output is emtpy array so path has not found. if output has value but
    // founded value is different with input path throw method not allowed exception.
    //
    if (empty($output)) {
        throw new Exception('Not found.', 404);
    } elseif ($input !== trim($output[0])) {
        throw new Exception('Method not allowed.', 405);
    }

    //
    // Prepare $args for path parameters.
    //
    $mark = $output['MARK'];
    $routeItem = $routes[$mark];
    $args = [];
    if (isset($routeItem['params'])) {
        array_walk($routeItem['params'], function ($value, $key) use (&$args, $output, $mark) {
            $args[$key] = $output[$key . $mark];
        });
    }

    //
    // If there is no callback for current route item throw server error.
    //
    if (isset($routeItem['callbacks']) === false) {
        throw new Exception('There is no callbacks array for `' . $input . '` path.', 500);
    }

    //
    // Invoke callback array of current route item.
    //
    array_walk($routeItem['callbacks'], function ($value, $key) use ($args) {
        global $request;
        call_user_func($value, $request, $args);
    });
}
