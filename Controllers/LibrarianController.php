<?php
class LibrarianController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct($model);
    }
    public function index()
    {
        $this->loadView("librarian");
    }
    public function home()
    {
        $this->loadView('home');
    }
}