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
        $obj = static::getMyInstance(null);
        $obj->loadLayout("adminHeader.html");
        $obj->loadView('Adminhome');
        $obj->loadLayout("adminFooter.html");
    }

    public function profile()
    {
        $obj = static::getMyInstance();
        $obj->loadLayout("adminHeader.html");
        $obj->loadView('adminProfile');
        $obj->loadLayout("adminFooter.html");
    }

    public function logout()
    {
        session_destroy();
        $obj = static::getMyInstance();
        $obj->redirect("login/admin");
    }
}