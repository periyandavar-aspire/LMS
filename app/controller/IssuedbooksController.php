<?php
class IssuedBooksController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new IssuedBooksModel());
    }
    
    public function manage()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadView('manageIssuedbooks');
        $this->loadLayout($user . "Footer.html");
    }

    public function issue()
    {
        $user = $this->input->session('type');
        $data['issuedBooks'] = $this->model->getIssuedBooks();
        $this->loadLayout($user . "Header.html");
        $this->loadView('manageIssuedbooks', $data);
        $this->loadLayout($user . "Footer.html");
        $this->includeScript("issuedbook.js");
    }

    public function getUserDetails()
    {
        $username = func_get_arg(0);
        $result = $this->model->getUserDetails($username);
        echo json_encode($result);
    }
    
    public function getBookDetails()
    {
        $isbnNumber = func_get_arg(0);
        $result = $this->model->getBookDetails($isbnNumber);
        echo json_encode($result);
    }

    public function add()
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $fields = new Fields(['username', 'isbnNumber', 'comments']);
        // $rules = [
        //     'fullName' => 'alphaSpaceValidation',
        // ];
        // $fields->addRule($rules);
        $fields->setRequiredFields('username', 'isbnNumber', 'comments');
        $fields->addValues($this->input->post());
        $flag = $fdv->validate($fields, $field);
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!')";
        } elseif (!$this->model->addIssuedBook($fields->getValues())) {
            $script = "toast('Unable to Add Entry..!')";
        } else {
            $script = "toast('New Entry Added Successfully..!')";
        }
        // $data['books'] = $this->model->getBooks();
        $this->loadLayout($user . "Header.html");
        $this->loadView("issueBook");
        $this->loadLayout($user . "Footer.html");
        $this->includeScript("issuedbook.js");
        $this->addScript($script);
    }
}
