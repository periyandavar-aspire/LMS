<?php
/**
 * BaseController
 * php version 7.3.5
 *
 * @category Controller
 * @package  Core
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
// namespace Lms\System\Core;
defined('VALID_REQ') or exit('Invalid request');
/**
 * Super class for all controller. All controllers should extend this controller
 * BaseController class consists of basic level functions for various purposes
 *
 * @category Controller
 * @package  Core
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class BaseController
{
    /**
     * Model class object that will has the link to the Model Class
     * using this variable we can acces the model class functions within this
     * controller Ex : $this->model->getData();
     *
     * @var Model $model
     */
    protected $model;

    /**
     * Autoload class objects
     *
     * @var array
     */
    private $_obj=[];

    /**
     * Input allows us to access the get, post, session, files values
     *
     * @var InputData $input
     */
    protected $input;

    /**
     * Service class object that will offers the services(bussiness logics)
     *
     * @var Service $service
     */
    protected $service;

    /**
     * Loader class object
     *
     * @var Loader
     */
    protected $load;

    /**
     * Log class instance
     *
     * @var Log
     */
    protected $log;

    /**
     * Instantiate the BaseController instance
     *
     * @param Model   $model   model class object to intialize $this->model
     * @param Service $service service class object to intialize $this->service
     */
    public function __construct($model = null, $service = null)
    {
        $this->model = $model;
        $this->service = $service;
        $this->input = new InputData();
        $this->load = Loader::autoLoadClass($this);
        $this->log = Log::getInstance();
        $this->log->info(
            "The " . static::class . " class is initalized successfully"
        );
    }


    /**
     * This function will load the required View(php) file without error on failure
     * only files with .php extension are allowed and those files should
     * store on View Folder
     *
     * @param string     $file filename without extension
     * @param array|null $data varaibles to passed to the view
     *
     * @return void
     */
    final protected function loadView(string $file, ?array $data = null)
    {
        global $config;
        $path = $config['view'] . '' . $file . ".php";
        if (file_exists($path)) {
            if ($data != null) {
                foreach ($data as $key => $value) {
                    $$key = $value;
                }
            }
            include_once $path;
        } else {
            $this->log->debug("Unable to load the $file view");
        }
    }

    /**
     * This function will redirect the page
     *
     * @param string $url       page to redirect
     * @param bool   $permanent optional default:false indicates
     *                          whether the redirect is permanent or not
     *
     * @return void
     */
    final protected function redirect(string $url, bool $permanent = false)
    {
        Utility::redirectURL($url, $permanent);
    }

    /**
     * This function loads html layout files
     *
     * @param string $file html filename with extension
     *
     * @return void
     */
    final protected function loadLayout(string $file)
    {
        global $config;
        $path = $config['layout'] . '/' . $file;
        file_exists($path)
            ? readfile($path)
            : $this->log->warning("Unable to load the $file layout");
    }

    /**
     * This functions include the script file
     *
     * @param string      $script filename with extension
     * @param string|null $path   optional default:true if its true
     *                            this function will include
     *                            JS from static directory
     *
     * @return void
     */
    final public function includeScript(string $script, ?string $path= null)
    {
        global $config;
        $script = ($path ?? ($config['static'] . '/static' . '/js'))
             . "/" . $script;
        echo "<script src='$script'></script>";
    }

    /**
     * This functions include the style sheet
     *
     * @param string      $sheet filename with extension
     * @param string|null $path  optional default:true if its true
     *                           this function will include
     *                           css from static directory
     *
     * @return void
     */
    final public function includeSheet($sheet, ?string $path= null)
    {
        global $config;
        $sheet = ($path ?? ($config['static'] . '/static/css'))
            . "/" . $sheet;
        echo "<link rel='stylesheet' type='text/css' href='$sheet'>";
    }


    /**
     * Adds the Js script on the view
     *
     * @param string $script Script
     *
     * @return void
     */
    final public function addScript(string $script)
    {
        echo "<script>" . $script . "</script>";
    }

    /**
     * Adds the CSS style on the view
     *
     * @param string $style Style
     *
     * @return void
     */
    final public function addStyle(string $style)
    {
        echo "<style>" . $style . "</style>";
    }

    /**
     * This function will call when the undefined function is called
     *
     * @param string $name function name
     * @param array  $args arguments
     *
     * @return void
     */
    public function __call(string $name, array $args)
    {
        $this->log->error("Undefined method call in $name " . get_called_class());
    }

    /**
     * This function will call when the undefined static function is called
     *
     * @param string $name function name
     * @param array  $args arguments
     *
     * @return void
     */
    public static function __callStatic($name, $args)
    {
        $this->log->error("Undefined static method call in " . get_called_class());
    }

    // /**
    //  * Making clone as deep copy instead of shallow
    //  *
    //  * @return void
    //  */
    // public function __clone()
    // {
    //     $this->model = clone $this->model;
    //     $this->service = clone $this->service;
    // }

    /**
     * Add new object to $_obj array
     *
     * @param string $name  name
     * @param mixed  $value object
     *
     * @return void
     */
    final public function __set(string $name, $value)
    {
        $this->_obj[$name] = $value;
    }

    /**
     * Get the object
     *
     * @param string $name object name
     *
     * @return mixed
     */
    final public function __get($name)
    {
        if (array_key_exists($name, $this->_obj)) {
            return $this->_obj[$name];
        }
        return null;
    }

    /**
     * Check the object is present or not
     *
     * @param string $name object name
     *
     * @return boolean
     */
    final public function __isset(string $name): bool
    {
        return array_key_exists($name, $this->_obj);
    }
}
