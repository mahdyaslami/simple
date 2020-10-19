<?php

/**
 * @param string $path
 * @return string
 */
function base_path($path)
{
    return __DIR__ . DIRECTORY_SEPARATOR . ltrim($path, '/\\');
}
