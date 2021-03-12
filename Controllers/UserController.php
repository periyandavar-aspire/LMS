<?php
class UserController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct($model);
    }
    public function index()
    {
        $this->loadView("index");
    }
    public function home()
    {
        echo "user home";
        $this->loadView("user");
    }

    public function profile()
    {
        echo "user profile";
        $this->loadView("user");
    }


    public function executeMethod($method)
    {
        if($method == "") {
            $method = "index";
        }
        if (method_exists($this, $method)) {
            static::$method(); 
        } else {
            echo "method not exists $method";
        }
    }
}