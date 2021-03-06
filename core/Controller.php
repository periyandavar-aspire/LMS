<?php
class Controller{
    private $model;
    public function __construct($model)
    {
        $this->model = $model;
    }
    public function loadView($file){
        $path=VIEWS_DIR.'/'.$file.".php";
        if(file_exists($path))
            require_once $path;
        else
            echo "$path not found";
    }
    public function redirect($url, $permanent = false){
        if (headers_sent() === false){
            header('Location: ../' . $url, true, ($permanent === true) ? 301 : 302);
        }
        exit();
    }
    public function index(){
        $this->loadView('index');
    }
}