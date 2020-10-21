<?php

namespace SSFW\Plugins;

final class Composer
{
    const PLUGINS_JSON = 'plugins.json';

    /**
     * @var null|array<string>
     */
    protected static $plugins = null;

    /**
     * @var null|string
     */
    protected static $basePath = null;

    /**
     * Installation Manager.
     */
    protected static $installationManager = null;

    /**
     * List of installed packages.
     * 
     * @var array
     */
    protected static $packages = null;

    /**
     * Callback after autoloading.
     */
    public static function postAutoloadDump($event)
    {
        self::config($event);

        foreach (self::$packages as $package) {
            if (self::install($package)) {
                echo "\"{$package}\" workspace installed successfully.\n";
            }
        }

        self::save();
    }


    /**
     * Base path of workspace.
     * 
     * @param string $path
     * @return 
     */
    public static function basePath($path = '')
    {
        if (self::$basePath) {
            $path = trim($path, '/\\');

            return self::$basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
        }

        self::$basePath = getcwd();

        return self::basePath($path);
    }

    /**
     * Get list of repositories.
     */
    protected static function config($event)
    {
        $composer = $event->getComposer();
        $repositoryManager = $composer->getRepositoryManager();
        self::$installationManager = $composer->getInstallationManager();
        $localRepository = $repositoryManager->getLocalRepository();
        self::$packages = $localRepository->getPackages();
        self::getPlugins();
    }

    /**
     * Get package install path.
     * 
     * @param string $package
     * @return string
     */
    protected static function getInstallPath($package)
    {
        return self::$installationManager->getInstallPath($package);
    }

    /**
     * Get list of installed plugins.
     * 
     * @return array<string>
     */
    protected static function getPlugins()
    {
        if (self::$plugins) {
            return self::$plugins;
        }

        $path = self::basePath(self::PLUGINS_JSON);

        if (!file_exists($path)) {
            return self::$plugins = [];
        }

        self::$plugins = json_decode(file_get_contents($path));

        if (!self::$plugins) {
            return self::$plugins = [];
        }

        return self::$plugins;
    }

    /**
     * Install a package workspace.
     * 
     * @param  string $path
     * @return bool
     */
    protected static function install($package)
    {
        $path = self::getInstallPath($package);

        $installer = $path . DIRECTORY_SEPARATOR . 'installer.php';
        if (!file_exists($path . DIRECTORY_SEPARATOR . 'installer.php')) {
            return false;
        }

        if (in_array($package, self::$packages)) {
            return false;
        }

        require_once($installer);

        array_push(self::$plugins, $package);



        return true;
    }

    /**
     * Save installed plugins.
     * 
     * @return bool
     */
    protected static function save()
    {
        return file_put_contents(self::basePath(self::PLUGINS_JSON), json_encode(self::$plugins));
    }
}
