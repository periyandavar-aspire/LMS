<?php
class LibrarianController extends UserController
{
    public function __construct($model = null)
    {
        parent::__construct($model);
    }
    public function index()
    {
        $this->loadView("librarian");
        setSessionData("user","librarian");
    }
    
    public function home()
    {
        $this->loadLayout("adminHeader.html");
        echo "librarian";
        $this->loadView('home');
        $this->loadLayout("adminFooter.html");
    }

    public function profile()
    {
        $this->loadLayout("adminHeader.html");
        echo "librarian";
        $this->loadView('adminProfile');
        $this->loadLayout("adminFooter.html");
    }
}