<?php
class UsersController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('addUsers');
        $this->loadLayout("adminFooter.html");
    }
    public function add()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('addUsers');
        $this->loadLayout("adminFooter.html");
    }
    public function manage()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('manageUsers');
        $this->loadLayout("adminFooter.html");
    }
}