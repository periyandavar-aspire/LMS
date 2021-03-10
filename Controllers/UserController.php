<?php
class UserController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct($model);
    }
    public function index()
    {
        $this->loadView("user");
    }
    public function home()
    {
        $this->redirect("user/");
    }
}