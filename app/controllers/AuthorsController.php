<?php
class AuthorsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('addAuthors');
        $this->loadLayout("adminFooter.html");
    }
    public function add()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('addAuthors');
        $this->loadLayout("adminFooter.html");
    }
    public function manage()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('manageAuthors');
        $this->loadLayout("adminFooter.html");
    }
}