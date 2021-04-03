<?php
/**
 * Super class for all controller. all controllers should extend this controller
 * Controller class consists of basic level functions for various purposes
 */
class BaseController
{
    /**
     * @var Model $model model class object that will has the link to the Model Class
     * using this variable we can acces the model class functions within this controller
     * Ex : $this->model->getData();
     */
    protected $model;
    /**
     * @var InputData $input allows us to access the get, post, session, files method
     */
    protected $input;
    /**
     * @var Service $service service class object that will offers the services(bussiness logics)
     */
    /**
     * Constructor menthod
     * @param Model $model model class object to intialize $this->model
     * @param Service $service service class object to intialize $this->service
     */
    public function __construct($model = null, $service = null)
    {
        $this->model = $model;
        $this->input = new InputData();
        $this->service = $service;
    }
    /**
     * This function will load the required View(php) file without error on failure
     * @param string $file filename without extensions
     * only files with .php extensions are allowed and those files should store on View Folder
     */
    protected function loadView(string $file, ?array $data = null)
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
            echo "$path not found";
        }
    }
    /**
     * This function will redirect the page
     * @param string $url page to redirect
     * @param bool  $permanent optional default:false indicates whether the redirect is permanent or not
     *
     */
    protected function redirect(string $url, bool $permanent = false)
    {
        Utility::redirectURL($url, $permanent);
    }
    /**
     *
     *
     */
    public function dispatch(string $url, bool $caseSensitive = false)
    {
        Route::dispatch($url, 'get', $caseSensitive);
        exit();
    }
    /**
     * This function loads html layout files
     * @param string $file html filename with extension
     * @access public
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
     * @param $script filename with extension
     * @param bool $path optional default:true if its true this function will include
     * css from static directory
     *
     */
    public function includeScript($script, ?string $path= null)
    {
        global $config;
        $path = $path ?? ($config['static'] . '/static' . '/js');
        $script = $path."/".$script;
        echo "<script src='$script'></script>";
    }
    
    /**
     * This functions include the style sheet
     * @param $style style sheet filename with extension
     * @param bool $path optional default:true if its true this function will include
     * css from static directory
     *
     */
    public function includeSheet($sheet, ?string $path= null)
    {
        global $config;
        $path = $path ?? ($config['static'] . '/static/css');
        $sheet = $path."/".$sheet;
        echo "<link rel='stylesheet' type='text/css' href='$sheet'>";
    }
    
    
    /**
     * adds the Js script on the view
     * @param string $script
     *
     * @return void
     */
    public function addScript(string $script)
    {
        echo "<script>" . $script . "</script>";
    }

    /**
     * adds the CSS style on the view
     * @param string $style
     *
     * @return void
     */
    public function addStyle(string $style)
    {
        echo "<style>" . $style . "</style>";
    }
    
    protected static function getMyInstance(?Model $model = null)
    {
        return new static();
    }

    public static function executeMethod($method)
    {
        if (method_exists(new static(), $method)) {
            static::$method();
        } else {
            echo "method not exists $method";
        }
    }

    public function __call($name, $args)
    {
        echo "error the page is not found..!";
    }

    public static function __callStatic($name, $args)
    {
        echo "echo the page is not found";
    }
    /**
     * making clone as deep copy instead of shallow by __clone magic method
     */
    public function __clone()
    {
        $this->model = clone $this->model;
    }
}
