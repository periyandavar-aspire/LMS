<?php
class LibrarianController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new AdminModel());
    }
    
    public function home()
    {
        $this->loadLayout("librarianHeader.html");
        $this->loadView('librarianHome');
        $this->loadLayout("librarianFooter.html");
    }

    public function profile()
    {
        $this->loadLayout("librarianHeader.html");
        $id = $this->input->session('id');
        $data['result'] = $this->model->getProfile($id);
        $this->loadView('librarianProfile', $data);
        $this->loadLayout("librarianFooter.html");
    }

    public function logout()
    {
        session_destroy();
        $this->redirect("librarian/login");
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
        $this->loadLayout("librarianHeader.html");
        $this->loadView("librarianProfile", $data);
        $this->loadLayout("librarianFooter.html");
        $this->addScript($msg);
    }

    public function categories()
    {
        $data['categories'] = $this->model->getCategories();
        $this->loadLayout("librarianHeader.html");
        $this->loadView("manageCategories", $data);
        $this->loadLayout("librarianFooter.html");
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
        $this->loadLayout("librarianHeader.html");
        $data['categories'] = $this->model->getCategories();
        $this->loadView("manageCategories", $data);
        $this->loadLayout("librarianFooter.html");
        $this->addScript($script);
    }

    
    public function authors()
    {
        $data['authors'] = $this->model->getAuthors();
        $this->loadLayout("librarianHeader.html");
        $this->loadView("manageAuthors", $data);
        $this->loadLayout("librarianFooter.html");
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
        $this->loadLayout("librarianHeader.html");
        $data['authors'] = $this->model->getAuthors();
        $this->loadView("manageAuthors", $data);
        $this->loadLayout("librarianFooter.html");
        $this->addScript($script);
    }

    public function issuedBooks()
    {
        $this->loadLayout("librarianHeader.html");
        $this->loadView("manageIssuedbooks");
        $this->loadLayout("librarianFooter.html");
    }

    public function manageUserRequest()
    {
        $this->loadLayout("librarianHeader.html");
        $this->loadView("manageUserRequest");
        $this->loadLayout("librarianFooter.html");
    }
}
