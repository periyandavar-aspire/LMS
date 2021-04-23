<?php
/**
 * BaseController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') OR exit('Not a valid Request');
/**
 * Super class for all controller. All controllers should extend this controller
 * BaseController class consists of basic level functions for various purposes
 *
 * @category   Controller
 * @package    Controller
 * @subpackage BaseController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
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

    private $_obj=[];

    /**
     * Input allows us to access the get, post, session, files method
     *
     * @var InputData $input
     */
    protected $input;

    /**
     * View object
     * 
     * @var BaseView
     */
    protected $view;

    /**
     * Service class object that will offers the services(bussiness logics)
     *
     * @var Service $service
     */
    protected $service;

    /**
     * Instance of BaseController
     *
     * @var BaseController
     */
    private $_instance;

    /**
     * Loader class object
     * 
     * @var Loader
     */
    protected $load;

    /**
     * Instantiate the BaseController instance
     *
     * @param Model   $model   model class object to intialize $this->model
     * @param Service $service service class object to intialize $this->service
     */
    public function __construct($model = null, $service = null)
    {
        $this->model = $model;
        $this->input = new InputData();
        $this->service = $service;
        $this->view = null;
        $this->load = Loader::autoLoadClass($this);
    }

    /**
     * Sets the view object
     *
     * @param BaseView $view View Object
     * 
     * @return void
     */
    public function setView(BaseView $view)
    {
        $this->view = $view;
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
    protected function loadTemplate(string $file, ?array $data = null)
    {
        global $config;
        $path = $config['template'] . '' . $file . ".php";
        if (file_exists($path)) {
            if ($data != null) {
                foreach ($data as $key => $value) {
                    $$key = $value;
                }
            }
            include_once $path;
        } else {
            echo "$path not found";
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
    protected function redirect(string $url, bool $permanent = false)
    {
        Utility::redirectURL($url, $permanent);
    }

    /**
     * This function will dispatch the request
     *
     * @param string $url           dispatch page url
     * @param bool   $caseSensitive whether the url is case sensitive or not
     *
     * @return void
     */
    public function dispatch(string $url, bool $caseSensitive = false)
    {
        Route::dispatch($url, 'get', $caseSensitive);
        exit();
    }

    /**
     * This function loads html layout files
     *
     * @param string $file html filename with extension
     *
     * @return void
     */
    protected function loadLayout(string $file)
    {
        global $config;
        $path = $config['layout'] . '/' . $file;
        if (file_exists($path)) {
            readfile($path);
        } else {
            echo "$path layout is missing";
        }
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
    public function includeScript(string $script, ?string $path= null)
    {
        global $config;
        $path = $path ?? ($config['static'] . '/static' . '/js');
        $script = $path."/".$script;
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
    public function includeSheet($sheet, ?string $path= null)
    {
        global $config;
        $path = $path ?? ($config['static'] . '/static/css');
        $sheet = $path."/".$sheet;
        echo "<link rel='stylesheet' type='text/css' href='$sheet'>";
    }


    /**
     * Adds the Js script on the view
     *
     * @param string $script Script
     *
     * @return void
     */
    public function addScript(string $script)
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
    public function addStyle(string $style)
    {
        echo "<style>" . $style . "</style>";
    }

    /**
     * Executes method will call the method in controller class
     *
     * @param string $method Method name
     *
     * @return void
     */
    public static function executeMethod(string $method)
    {
        if (method_exists(new static(), $method)) {
            static::$method();
        } else {
            echo "method not exists $method";
        }
    }


    /**
     * Returns instance
     *
     * @return BaseController
     */
    public static function getInstance(): BaseController
    {
        return self::$_instance;
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
        echo "Error the page $name is not found..!";
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
        echo "echo the page is not found";
    }

    /**
     * Making clone as deep copy instead of shallow
     *
     * @return void
     */
    public function __clone()
    {
        $this->model = clone $this->model;
    }
    /**
     * Add new object to $_obj array
     *
     * @param string $name  name
     * @param mixed  $value object
     * 
     * @return void
     */ 
    public function __set(string $name, $value)
    {
        $this->_obj[$name] = $value;
    }

    /**
     * Get the object
     *
     * @param string $name object name
     * 
     * @return object|null
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_obj)) {
            return $this->_obj[$name];
        }
        return null;
    }
}
