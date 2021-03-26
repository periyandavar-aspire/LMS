<?php
class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct(null);
    }

    // public function index()
    // {
    //     static::home();
    // }

    public function home()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('Adminhome');
        $this->loadLayout("adminFooter.html");
    }

    public function profile()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('adminProfile');
        $this->loadLayout("adminFooter.html");
    }

    public function logout()
    {
        session_destroy();
        $this->redirect("admin/login");
    }
}
