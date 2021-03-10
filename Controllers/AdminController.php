<?php
class AdminController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $this->loadView("admin");
    }

    public function home()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('home');
        $this->loadLayout("adminFooter.html");
    }

    public function profile()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('adminProfile');
        $this->loadLayout("adminFooter.html");
    }

    public function settings()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('settings');
        $this->loadLayout("adminFooter.html");
    }

    public function uploadLogo()
    {
        $this->loadLayout("adminHeader.html");
        $data = [];
        if($this->uploadFile($this->input->files('logobanar'), "static/img/lms-logo.jpg",true))
            $data["msg"] = "Logo is uploaded successfully..!";
        else
            $data["msg"] = "File upload failed..!";
        $this->loadView('settings', $data);
        $this->loadLayout("adminFooter.html");
    }

    public function updatePageSettings()
    {
        $this->loadLayout("adminHeader.html");
        $data = [];
        $fdv = new FormDataValidation();
        $data["pageMsg"] = $fdv->customizeInput(
            $this->input->post('mobileno'),
            new class implements ValidationRule {
                public function validate($data)
                {
                    return preg_match('/^[6789]\d{9}$/', $data);
                }
                public function format($data)
                {
                    return "+91 " . $data;
                }
            }
        );
        // $data["pageMsg"] = "valid";
        $this->loadView('settings', $data);
        $this->loadLayout("adminFooter.html");
    }
}