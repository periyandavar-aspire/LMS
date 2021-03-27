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
            $msg = "Invalid $field..!";
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
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageCategories");
        $this->loadLayout("adminFooter.html");
    }

    public function addCategory()
    {
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageCategories");
        $this->loadLayout("adminFooter.html");
        $this->addScript("toast('Unable to add new category..!', 'danger');");
    }
}
