<?php

namespace SSFW\Plugins;

final class Composer
{
    public static function postAutoloadDump()
    {
        $installedPlugins = self::getInstalledPlugins();
        $GLOBALS['installedPlugins'] = $installedPlugins;

        $GLOBALS['hasInstalledPlugin'] = false;
        if (count($installedPlugins)) {
            $GLOBALS['hasInstalledPlugin'] = true;
        }

        require_once(__DIR__ . '/../vendor/autoload.php');
        
        self::saveInstalledPlugins($GLOBALS['installedPlugins']);
    }

    /**
     * Get list of installed plugins.
     * 
     * @return array<string>
     */
    protected static function getInstalledPlugins()
    {
        return json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'plugins.json'));
    }

    protected static function saveInstalledPlugins($json) 
    {
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'plugins.json', json_encode($json));
    }
}
