<?php
class ErrorsController extends BaseController implements ErrorHandler
{
    public function __construct()
    {
        parent::__construct();
    }
    public function pageNotFound()
    {
        header('HTTP/1.1 404 Not Found');
        $this->loadLayout("header.html");
        $data['msg'] = "The Page you're looking for isn't here. This may be missing or temporarily unavailable. You can click the button below to go back to the homepage.";
        $this->loadView("pageNotFound", $data);
        $this->loadLayout("footer.html");
        // setSessionData("user","user");
    }
    public function invalidRequest()
    {
        header('HTTP/1.1 400 Bad Request');
        $this->loadLayout("header.html");
        $data['msg'] = "Your request is invalid or that service is removed. Please try again later...";
        $this->loadView("pageNotFound", $data);
        $this->loadLayout("footer.html");
    }
    public function serverError()
    {
        header('HTTP/1.1 500 Internal Server Error');
        $this->loadLayout("header.html");
        $data['msg'] = "On error occured while proccessing your request... Please check later and retry again...";
        $data['data'] = func_get_arg(0);
        $this->loadView("serverError", $data);
        $this->loadLayout("footer.html");
    }
}
