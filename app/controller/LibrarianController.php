<?php
class LibrarianController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    // public function index()
    // {
    //     $this->loadView("librarian");
    //     setSessionData("user","librarian");
    // }
    
    public function home()
    {
        $this->loadLayout("librarianHeader.html");
        $this->loadView('librarianHome');
        $this->loadLayout("librarianFooter.html");
    }

    public function profile()
    {
        $this->loadLayout("librarianHeader.html");
        $this->loadView('librarianProfile');
        $this->loadLayout("librarianFooter.html");
    }

    public function logout()
    {
        $this->redirect("login/librarian");
    }
}
