<?php
class ManageUserController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new ManageUserModel());
    }
    public function getAllUsers()
    {
        $user = $this->input->session('type');
        $currentUser = $this->input->session('id');
        $data['users'] = $this->model->getAllUsers($currentUser);
        $this->loadLayout("adminHeader.html");
        $this->loadView("adminManageUsers", $data);
        $this->loadLayout("adminFooter.html");
        $this->includeScript("populate.js");
    }

    public function getRegUsers()
    {
        $user = $this->input->session('type');
        $currentUser = $this->input->session('id');
        $data['users'] = $this->model->getRegUsers();
        $this->loadLayout("librarianHeader.html");
        $this->loadView("librarianManageUsers", $data);
        $this->loadLayout("librarianFooter.html");
    }

    public function getUserRoles()
    {
        $result = $this->model->getAllRoles();
        echo json_encode($result);
    }

    public function delete()
    {
        $role = func_get_arg(0);
        $id = func_get_arg(1);
        $result['result'] = $this->model->delete($role, $id);
        echo json_encode($result);
    }
    public function addUser()
    {
        $fdv = new FormDataValidation();
        $fields = new Fields(['fullName', 'email', 'role', 'password']);
        // $rules = [
        //     'fullName' => 'alphaSpaceValidation',
        // ];
        // $fields->addRule($rules);
        $fields->setRequiredFields('fullName', 'email', 'role', 'password');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->addAdminUser($fields->getValues())) {
            $script = "toast('Unable to add new user..!', 'danger');";
        } else {
            $script = "toast('New user added successfully..!', 'success');";
        }
        $currentUser = $this->input->session('id');
        $data['users'] = $this->model->getAllUsers($currentUser);
        $this->loadLayout("adminHeader.html");
        $this->loadView("adminmanageUsers", $data);
        $this->loadLayout("adminFooter.html");
        $this->includeScript("populate.js");
        $this->addScript($script);
    }
}
