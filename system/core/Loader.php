<?php
/**
 * Loader File
 * php version 7.3.5
 *
 * @category   Loader
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

defined('VALID_REQ') or exit('Not a valid Request');

/**
 * Loader Class autoloads the files
 *
 * @category   Loader
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class Loader
{
    /**
     * Loader class instance
     *
     * @var Loader|null $_instance
     */
    private static $_instance = null;

    private static $_autoLoadClasses = [];

    /**
     * Instantiate the new Loader instance
     */
    public function __construct()
    {
        $this->_defaultRegister();
        $this->loadAll('system/core');
        $this->_autoloader();
        $this->loadAll('app/config/routes');
    }

    /**
     * Register new spl_autoload_register callback fucntion
     *
     * @param callable $callback Callback function
     *
     * @return void
     */
    public function regiterAutoload(callable $callback)
    {
        spl_autoload_register($callback);
    }

    /**
     * Loads the all files from autoload files list
     *
     * @return void
     */
    private function _autoloader()
    {
        global $autoload;
        foreach ($autoload['auto-file'] as $file) {
            $file = str_ireplace(".php", "", $file);
            $file = $file . '.php';
            if (file_exists($file)) {
                include_once $file;
            }
        }
        foreach ($autoload['auto-class'] as $class) {
            $class = ucfirst(str_ireplace(".php", "", $class));
            $file = "app/libraries/" . $class .".php";
            if (file_exists($file)) {
                include_once $file;
            }
            static::$_autoLoadClasses[] = new $class();
        }
    }

    /**
     * Loads the all classes from autoload class list
     * and creates the instance for them
     *
     * @param BaseController $ctrl Controller object
     *
     * @return void
     */
    public static function autoLoadClass(BaseController $ctrl)
    {
        global $autoload;
        if (!isset($_instance)) {
            foreach (static::$_autoLoadClasses as $obj) {
                $ctrl->{lcfirst(get_class($obj))} = $obj;
            }
        }
    }

    /**
     * Checks whether the class is loaded or not
     *
     * @param string $class Class Name
     *
     * @return string
     */
    public function isLoaded($class): bool
    {
        $loadedFiles = get_included_files();
        return in_array(ucfirst($class), $loadedFiles, true);
    }

    /**
     * Loads all php files from the specified directory
     *
     * @param string $dir Directory Name
     *
     * @return void
     */
    public function loadAll(string $dir)
    {
        foreach (glob("$dir/*.php") as $filename) {
            include_once $filename;
        }
    }

    /**
     * Sets Default autoload register
     *
     * @return void
     */
    private function _defaultRegister()
    {
        spl_autoload_register(
            function ($className) {
                $file = 'system/libraries/' . $className . ".php";
                if (file_exists($file)) {
                    include_once $file;
                }
            }
        );

        spl_autoload_register(
            function ($className) {
                global $config;
                if (Utility::endsWith(strtolower($className), 'controller')) {
                    $ctrlPath = $config['controller'];
                    $file = $ctrlPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'model')) {
                    $ModelPath = $config['model'];
                    $file = $ModelPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'service')) {
                    $ModelPath = $config['service'];
                    $file = $ModelPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'driver')) {
                    $DriverPath = 'system/database/driver/';
                    $file = $DriverPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'view')) {
                    $ViewPath = $config['view'];
                    $file = $ViewPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                }
            }
        );
    }

    /**
     * Intialize the Loader class and returns load class object
     *
     * @return Loader
     */
    public static function intialize(): Loader
    {
        if (self::$_instance == null) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }
}
