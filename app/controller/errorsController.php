<?php
class ErrorsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function pageNotFound()
    {
        $this->loadLayout("header.html");
        $this->loadView("pageNotFound");
        $this->loadLayout("footer.html");
        // setSessionData("user","user");
    }
    public function invalidRequest()
    {
        $this->loadLayout("header.html");
        $this->loadView("books");
        $this->loadLayout("footer.html");
    }
    public function serverError()
    {
        $this->loadLayout("header.html");
        $this->loadView("aboutus");
        $this->loadLayout("footer.html");
    }
}
