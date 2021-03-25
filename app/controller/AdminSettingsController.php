<?php
class AdminSettingsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('settings');
        $this->loadLayout("adminFooter.html");
    }

    public function uploadLogo()
    {
        $this->loadLayout("adminHeader.html");
        $data = [];
        if ($this->uploadFile($this->input->files('logobanar'), "static/img/lms-logo.jpg", true)) {
            $data["msg"] = "Logo is uploaded successfully..!";
        } else {
            $data["msg"] = "File upload failed..!";
        }
        $this->loadView('settings', $data);
        $this->loadLayout("adminFooter.html");
    }

    public function updatePageSettings()
    {
        $this->loadLayout("adminHeader.html");
        $data = [];
        $fdv = new FormDataValidation();
        $fields = new fields(['aboutus','address','mobileno','vision','mail']);
        $fields->addFields('mission');
        $fields->addRule(['mail' => "mailValidation"]);
        $fields->addValues($this->input->post());
        $fields->addCustomeRule(
            'mobileno',
            new class implements ValidationRule {
                public function validate(?string $data): ?bool
                {
                    return preg_match('/^[6789]\d{9}$/', $data);
                }
                // public function format($data)
                // {
                //     return "+91 " . $data;
                // }
                public function format(?string $data): ?string
                {
                    return $data;
                }
            }
        );
        if (!$fdv->validate($fields)) {
            $data["pageMsg"] = "invalid";
        } else {
            $data['data'] = $fields->getData();
        }
        $this->loadView('settings', $data);
        $this->loadLayout("adminFooter.html");
    }
}
