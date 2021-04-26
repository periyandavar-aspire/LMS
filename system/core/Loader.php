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
     * Controller object
     */
    private static $_ctrl;

    /**
     * Instantiate the new Loader instance
     */
    public function __construct()
    {
        $this->_defaultRegister();
        $this->loadAll('system/core');
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
     * Loads the all classes from autoload class list
     * and creates the instance for them
     *
     * @param BaseController $ctrl Controller object
     *
     * @return null|Loader
     */
    public static function autoLoadClass(BaseController $ctrl): ?Loader
    {
        global $autoload;
        if (isset(static::$_instance)) {
            static::$_ctrl = $ctrl;
            $models = $autoload['model'];
            is_array($models) or $models = array($models);
            static::$_instance->model(...$models);
            $services = $autoload['service'];
            is_array($services) or $services = array($services);
            static::$_instance->service(...$services);
            $libraries = $autoload['library'];
            is_array($libraries) or $libraries = array($libraries);
            static::$_instance->library(...$libraries);
            $helpers = $autoload['helper'];
            is_array($helpers) or $helpers = array($helper);
            static::$_instance->helper(...$helpers);
            return static::$_instance;
        }
        return null;
    }

    /**
     * Loads models
     *
     * @param string ...$models Model list
     *
     * @return void
     */
    public function model(...$models)
    {
        global $config;
        foreach ($models as $model) {
            $file = $config['model'] . '/' . $model . '.php';
            if (file_exists($file)) {
                include_once $file;
                static::$_ctrl->{lcfirst($model)} = new $model();
            } else {
                throw new Exception("Model class '$model' not found");
            }
        }
    }

    /**
     * Loads Services
     *
     * @param string ...$services Service list
     *
     * @return void
     */
    public function service(...$services)
    {
        global $config;
        foreach ($services as $service) {
            $file = $config['service'] . '/' . $service . '.php';
            if (file_exists($file)) {
                include_once $file;
                static::$_ctrl->{lcfirst($service)} = new $service();
            } else {
                throw new Exception("Service class '$service' not found");
            }
        }
    }

    /**
     * Loads Libraries
     *
     * @param string ...$libraries Library list
     *
     * @return void
     */
    public function library(...$libraries)
    {
        global $config;
        foreach ($libraries as $library) {
            if (file_exists($config['library'] . $library . '.php')) {
                include_once $config['library'] . $library . '.php';
                static::$_ctrl->{lcfirst($library)} = new $library();
            } elseif (file_exists("system/library/" . $library . '.php')) {
                include_once "system/library/" . $library . '.php';
                static::$_ctrl->{lcfirst($library)} = new $library();
            } else {
                throw new Exception("Library class '$library' not found");
            }
        }
    }


    /**
     * Loads helpers
     *
     * @param string ...$helpers Helper list
     *
     * @return void
     */
    public function helper(...$helpers)
    {
        global $config;
        foreach ($helpers as $helper) {
            if (file_exists($config['helper'] . '/' . $helper . '.php')) {
                include_once $config['helper'] . '/' . $helper . '.php';
            } elseif (file_exists('system/helper/' . $helper . '.php')) {
                include_once 'system/helper/' . $helper . '.php';
            } else {
                throw new Exception("Helper class '$helper' not found");
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
                $file = 'system/library/' . $className . ".php";
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
