<?php

/**
 * Get current container instance.
 * 
 * @return \League\Container\Container
 */
function container(): \League\Container\Container
{
    if (!isset($GLOBALS['container'])) {
        $GLOBALS['container'] = new \League\Container\Container;
    }

    return $GLOBALS['container'];
}

/**
 * Get class from container.
 * 
 * @param  string $id
 * @return mixed
 */
function resolve(string $id)
{
    return container()->get($id);
}
