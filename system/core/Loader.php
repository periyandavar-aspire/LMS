<?php
/**
 * Loader
 * php version 7.3.5
 *
 * @category Loader
 * @package  Core
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');
/**
 * Loader Class autoloads the files
 *
 * @category Loader
 * @package  Core
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class Loader
{
    /**
     * Loader class instance
     *
     * @var Loader|null $_instance
     */
    private static $_instance = null;

    /**
     * Controller object
     *
     * @var Loader
     */
    private static $_ctrl;

    /**
     * Instantiate the the Loader instance
     */
    public function __construct()
    {
        $this->_defaultRegister();
        $this->loadAll('system/core');
        $this->loadAll('system/database');
        $this->loadAll('app/config/routes');
    }

    /**
     * Loads the all classes from autoload class list
     * and creates the instance for them
     *
     * @param BaseController $ctrl Controller object
     *
     * @return Loader
     * @throws FrameworkException
     */
    public static function autoLoadClass(BaseController $ctrl): Loader
    {
        global $autoload;
        $loads = ['model', 'service', 'library', 'helper'];
        if (isset(static::$_instance)) {
            static::$_ctrl = $ctrl;
            foreach ($loads as $load) {
                $files = $autoload[$load];
                is_array($files) or $files = array($files);
                static::$_instance->$load(...$files);
            }
            return static::$_instance;
        }
        throw new FrameworkException("Loader class is not Initialized");
    }

    /**
     * Loads models
     *
     * @param string ...$models Model list
     *
     * @return void
     * @throws FrameworkException
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
                throw new FrameworkException(
                    "Unable to locate the model class '$model'"
                );
            }
        }
    }

    /**
     * Loads Services
     *
     * @param string ...$services Service list
     *
     * @return void
     * @throws FrameworkException
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
                throw new FrameworkException(
                    "Unable to loacate the '$service' class"
                );
            }
        }
    }

    /**
     * Loads Libraries
     *
     * @param string ...$libraries Library list
     *
     * @return void
     * @throws FrameworkException
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
                throw new FrameworkException("Library class '$library' not found");
            }
        }
    }


    /**
     * Loads helpers
     *
     * @param string ...$helpers Helper list
     *
     * @return void
     * @throws FrameworkException
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
                throw new FrameworkException("Helper class '$helper' not found");
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
                global $config;
                if (Utility::endsWith(strtolower($className), 'controller')) {
                    $file = $config['controller'] . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'model')) {
                    $file = $config['model'] . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'service')) {
                    $file = $config['service'] . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'driver')) {
                    $file = 'system/database/driver/' . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } else {
                    $file = 'system/library/' . $className . ".php";
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
