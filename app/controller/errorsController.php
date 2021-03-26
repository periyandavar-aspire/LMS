<?php
class ErrorsController extends BaseController implements ErrorHandler
{
    public function __construct()
    {
        parent::__construct();
    }
    public function pageNotFound()
    {
        $this->loadLayout("header.html");
        $data['msg'] = "The Page you're looking for isn't here. This may be missing or temporarily unavailable. You can click the button below to go back to the homepage.";
        $this->loadView("pageNotFound", $data);
        $this->loadLayout("footer.html");
        // setSessionData("user","user");
    }
    public function invalidRequest()
    {
        $this->loadLayout("header.html");
        $data['msg'] = "Your request is invalid or that service is removed. Please try again later...";
        $this->loadView("pageNotFound", $data);
        $this->loadLayout("footer.html");
    }
    public function serverError()
    {
        $this->loadLayout("header.html");
        $this->loadView("aboutus");
        $this->loadLayout("footer.html");
    }
}
