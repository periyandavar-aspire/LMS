<?php
class LibrarianController extends BaseController
{
    public function __construct()
    {
        parent::__construct($model);
    }
    // public function index()
    // {
    //     $this->loadView("librarian");
    //     setSessionData("user","librarian");
    // }
    
    public static function home()
    {
        $obj = static::getMyInstance();
        $obj->loadLayout("librarianHeader.html");
        $obj->loadView('librarianHome');
        $obj->loadLayout("librarianFooter.html");
    }

    public static function profile()
    {
        $obj = static::getMyInstance();
        $obj->loadLayout("librarianHeader.html");
        $obj->loadView('librarianProfile');
        $obj->loadLayout("librarianFooter.html");
    }

    public static function logout()
    {
        $obj = static::getMyInstance();
        $obj->redirect("login/librarian");
    }
}