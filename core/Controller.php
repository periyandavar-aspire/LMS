<?php
/**
 * Super class for all controller. all controllers should extend this controller
 * Controller class consists of basic level functions for various purposes
 */
class Controller{
    /**
     * @var Model $model model class object that will has the link to the Model Class
     * using this variable we can acces the model class functions within this controller 
     * Ex : $this->model->getData();
     */
    private $model;
    /**
     * Constructor menthod
     * @param Model $model model class object to intialize $this->model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }
    /**
     * This function will load the required View(php) file without error on failure
     * @param string $file filename without extensions
     * only files with .php extensions are allowed and those files should store on View Folder
     */
    public function loadView($file){
        $path=VIEWS_DIR.'/'.$file.".php";
        if(file_exists($path))
            include_once $path;
        else
            echo "$path not found";
    }
    /**
     * This function will redirect the page
     * @param string $url page to redirect
     * @param bool  $permanent optional default:false indicates whether the redirect is permanent or not
     * 
     */
    public function redirect($url, $permanent = false){
        if (headers_sent() === false){
            header('Location: ../' . $url, true, ($permanent === true) ? 301 : 302);
        }
        exit();
    }
    /**
     * Default index function for the controller
     * if the index method is not defined in the sub class then this function will called and
     * loads default index page
     */
    public function index(){
        $this->loadView('index');
    }
    /**
     * This function loads html layout files
     * @param string $file html filename with extension
     * @access public
     */
    public function loadLayout($file){
        $path = LAYOUT_DIR.'/'.$file;
        if(file_exists($path))
            readfile($path);
        else
            echo "$path layout is missing";
    }
    /**
     * This functions load the style sheet
     * @param $style style sheet filename with extension
     * @param bool $staticPath optional default:true if its true this function will load
     * css from static directory
     *  
     */
    // public function addCSS($style,$staticPath){
    //     $path = ($staticPath) ? (STATIC_DIR."/".$style) : $style;
    //     if(file_exists($path))
    //         readfile($path);
    //     else
    //         echo "$path style sheet is missing";
    // }
    // /**
    //  * This functions load the script
    //  * @param $script script filename with extension
    //  * @param bool $staticPath optional default:true if its true this function will load
    //  * script from static directory
    //  *  
    //  */
    // public function addJS($script,$staticPath){
    //     $path = ($staticPath) ? (STATIC_DIR."/".$script) : $script;
    //     if(file_exists($path))
    //         readfile($path);
    //     else
    //         echo "$path script is missing";
    // }
    /**
     * This function allows you to access the configuration values from config array using its key
     * @param string $key key of the config to be retrieved
     * @return mixed $value value of the config or NULL if the key is undefined
     * 
     */
    public function getConfig($key){

    }

}