<?php
class UsersController extends Controller{
    public function __construct($model=null)
    {
        parent::__construct($model);
    }
    public function index(){
        $this->loadLayout("adminHeader.html");
        $this->loadView('addUsers');
        $this->loadLayout("adminFooter.html");
    }
    public function add(){
        $this->loadLayout("adminHeader.html");
        $this->loadView('addUsers');
        $this->loadLayout("adminFooter.html");
    }
    public function manage(){
        $this->loadLayout("adminHeader.html");
        $this->loadView('manageUsers');
        $this->loadLayout("adminFooter.html");
    }
}