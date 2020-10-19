<?php

/**
 * plugin.json contain plugins order and bootstrap file.
 * 
 * Example:
 *  { "order": 2.0, "bootstrap": "test.php" }
 */
$plugins = file_get_contents(base_path('plugins.json'));

$plugins = json_decode($plugins);

usort($plugins, fn ($a, $b) => $a->order - $b->order);

foreach($plugins as $plugin) {
    require_once($plugin->bootstrap);
}