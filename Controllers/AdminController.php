<?php
class AdminController extends Controller{
    public function __construct($model=null)
    {
        parent::__construct($model);
    }
    public function index(){
        $this->loadView("admin");
    }
    public function home(){
        $this->loadView('home');
    }
}