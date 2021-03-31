<?php
class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new AdminModel);
    }

    public function home()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView('Adminhome');
        $this->loadLayout("adminFooter.html");
    }

    public function profile()
    {
        $this->loadLayout("adminHeader.html");
        $id = $this->input->session('id');
        $data['result'] = $this->model->getProfile($id);
        $this->loadView('adminProfile', $data);
        $this->loadLayout("adminFooter.html");
    }

    public function logout()
    {
        session_destroy();
        $this->redirect("admin/login");
    }
    
    public function updateProfile()
    {
        $fdv = new FormDataValidation();
        $id = $this->input->session('id');
        $fields = new Fields(['fullname']);
        $rules = [
            'fullName' => 'alphaSpaceValidation',
        ];
        $fields->addRule($rules);
        $fields->setRequiredFields('fullname');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $msg = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->updateProfile($id, $fields->getValues())) {
            $msg = "toast('Unable to update the profile..!', 'danger');";
        } else {
            $msg = "toast('Profile updated successfully..!', 'success');";
        }
        $password = $this->input->post('password');
        if ($password != '') {
            if (strlen($password) < 6) {
                $msg .= "toast('Your password is too short & not updated..!', 'danger');";
            } else {
                if (!$this->model->updatePassword($id, $password)) {
                    $msg .= "toast('Unable to update password..!', 'danger');";
                }
            }
        }
        $data['result'] = $this->model->getProfile($id);
        $this->loadLayout("adminHeader.html");
        $this->loadView("adminProfile", $data);
        $this->loadLayout("adminFooter.html");
        $this->addScript($msg);
    }

    public function categories()
    {
        $data['categories'] = $this->model->getCategories();
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageCategories", $data);
        $this->loadLayout("adminFooter.html");
    }

    public function addCategory()
    {
        $fdv = new FormDataValidation();
        $fields = new Fields(['name']);
        $fields->setRequiredFields('name');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->addCategory($fields->getValues())) {
            $script = "toast('Unable to add new category..!', 'danger');";
        } else {
            $script = "toast('New category is added successfully..!', 'success');";
        }
        $this->loadLayout("adminHeader.html");
        $data['categories'] = $this->model->getCategories();
        $this->loadView("manageCategories", $data);
        $this->loadLayout("adminFooter.html");
        $this->addScript($script);
    }

    public function authors()
    {
        $data['authors'] = $this->model->getAuthors();
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageAuthors", $data);
        $this->loadLayout("adminFooter.html");
    }

    public function addAuthor()
    {
        $fdv = new FormDataValidation();
        $fields = new Fields(['name']);
        $fields->setRequiredFields('name');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->addAuthor($fields->getValues())) {
            $script = "toast('Unable to add new author..!', 'danger');";
        } else {
            $script = "toast('New author is added successfully..!', 'success');";
        }
        $this->loadLayout("adminHeader.html");
        $data['authors'] = $this->model->getAuthors();
        $this->loadView("manageAuthors", $data);
        $this->loadLayout("adminFooter.html");
        $this->addScript($script);
    }

    

    public function settings()
    {
        $data['data'] = $this->model->getConfigs();
        $this->loadLayout("adminHeader.html");
        $this->loadView("settings", $data);
        $this->loadLayout("adminFooter.html");
    }

    public function updateSettings()
    {
        $fdv = new FormDataValidation();
        $fields = new Fields(['maxBookLend', 'maxLendDays', 'maxBookRequest', 'fineAmtPerDay']);
        $fields->setRequiredFields('maxBookLend', 'maxLendDays', 'maxBookRequest', 'fineAmtPerDay');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->updateSettings($fields->getValues())) {
            $script = "toast('Unable to update the settings..!', 'danger');";
        } else {
            $script = "toast('Settings updated successfully..!', 'success');";
        }
        $data['data'] = $this->model->getConfigs();
        $this->loadLayout("adminHeader.html");
        $this->loadView("settings", $data);
        $this->loadLayout("adminFooter.html");
        $this->addScript($script);
    }

    public function cms()
    {
        $data['data'] = $this->model->getCmsConfigs();
        $this->loadLayout("adminHeader.html");
        $this->loadView("cms", $data);
        $this->loadLayout("adminFooter.html");
    }

    public function updateCms()
    {
        $fdv = new FormDataValidation();
        $fields = new Fields(['aboutus', 'address', 'email', 'fbUrl', 'ytUrl', 'instaUrl', 'vision', 'mission']);
        $fields->setRequiredFields('aboutus', 'address', 'email', 'fbUrl', 'ytUrl', 'instaUrl', 'vision', 'mission');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->updateCmsConfigs($fields->getValues())) {
            $script = "toast('Unable to update the settings..!', 'danger');";
        } else {
            $script = "toast('Settings updated successfully..!', 'success');";
        }
        $data['data'] = $this->model->getCmsConfigs();
        $this->loadLayout("adminHeader.html");
        $this->loadView("cms", $data);
        $this->loadLayout("adminFooter.html");
        $this->addScript($script);
    }

    public function issuedBooks()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageIssuedbooks");
        $this->loadLayout("adminFooter.html");
    }

    public function manageUsers()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageUsers");
        $this->loadLayout("adminFooter.html");
    }

    public function manageUserRequest()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageUserRequest");
        $this->loadLayout("adminFooter.html");
    }
}
