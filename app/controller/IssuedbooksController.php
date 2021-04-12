<?php
class IssuedBooksController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new IssuedBooksModel(), new IssuedBooksService());
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
        $issuedBooks = $this->model->getIssuedBooks();
        $fineSettings = $this->model->getFineConfigs();
        $data['issuedBooks'] = $this->service->calculateFine($issuedBooks, $fineSettings);
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadView('manageissuedbooks', $data);
        $this->loadLayout($user . "Footer.html");
    }

    public function markAsReturn()
    {
        $id = func_get_arg(0);
        $result['result'] = $this->model->bookReturned($id);
        echo json_encode($result);
    }
    public function manageUserRequest()
    {
        $user = $this->input->session('type');
        $data['issuedBooks'] = $this->model->getRequestBooks();
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadView('manageUserRequest', $data);
        $this->loadLayout($user . "Footer.html");
        if ($this->input->session('msg') != null) {
            $this->addScript("toast('" . $this->input->session('msg') . "')");
            Utility::setSessionData('msg', null);
        }
    }

    public function getUserDetails()
    {
        $username = func_get_arg(0);
        $result = $this->model->getUserDetails($username);
        $result->condition = $this->service->checkUserCondition($result, $this->model->getMaxBooksToLend());
        echo json_encode($result);
    }
    
    public function getBookDetails()
    {
        $isbnNumber = func_get_arg(0);
        $result = $this->model->getBookDetails($isbnNumber);
        echo json_encode($result);
    }

    public function manageRequest()
    {
        $id = func_get_arg(0);
        $user = $this->input->session('type');
        $result = $this->model->getRequestDetails($id);
        $data['user'] = $this->model->getUserDetails($result->userName);
        $data['book'] = $this->model->getBookDetails($result->isbnNumber);
        $data['comments'] = $result->comments;
        $data['id'] = $id;
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadView('userRequest', $data);
        $this->loadLayout($user . "Footer.html");
    }

    public function updateRequest()
    {
        $id = func_get_arg(0);
        $updateTo = $this->input->post('status');
        $flag = $this->model->updateRequest($id, $updateTo, $this->input->post(comments));
        $script = $flag == true ? 'Success..!':'Failed..!';
        Utility::setSessionData('msg', $script);
        $this->redirect('userRequest');
    }

    public function add()
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $fields = new Fields(['username', 'isbnNumber', 'comments']);
        $rules = [
            'username' => 'alphaSpaceValidation',
        ];
        $fields->addRule($rules);
        $fields->setRequiredFields('username', 'isbnNumber');
        $fields->addValues($this->input->post());
        $flag = $fdv->validate($fields, $field);
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!')";
        } else {
            $values = $fields->getValues();
            $userDetail = $this->model->getUserDetails($values['username']);
            $bookDetail = $this->model->getBookDetails($values['isbnNumber']);
            $maxLendBook = $this->model->getMaxBooksToLend();
            if (!$this->service->checkLendCondition($userDetail, $bookDetail, $maxLendBook, $msg)) {
                $script = "toast('$msg..!', 'danger')";
            } elseif (!$this->model->addIssuedBook($values)) {
                $script = "toast('The user alredy lend a copy of this book..!','danger')";
            } else {
                $script = "toast('New Entry Added Successfully..!','success')";
            }
        }
        $issuedBooks = $this->model->getIssuedBooks();
        $fineSettings = $this->model->getFineConfigs();
        $data['issuedBooks'] = $this->service->calculateFine($issuedBooks, $fineSettings);
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        print_r($this->input->post());
        $this->loadView("manageissuedbooks", $data);
        $this->loadLayout($user . "Footer.html");
        $this->addScript($script);
    }
    public function request()
    {
        $id = func_get_arg(0);
        $msg = null;
        $result['result'] = 0;
        $user = $this->input->session('id');
        $flag = $this->service->checkRequestCondition(
            $this->model->getUserDetails($user),
            $this->model->getBookDetails($id),
            $this->model->getMaxVals(),
            $msg
        );
        if ($flag) {
            if (!$this->model->requestBook($user, $id)) {
                $msg = "You already requested this book";
            } else {
                $msg = "success..!";
                $result['result'] = 1;
            }
        }
        $result['msg'] = $msg;
        echo json_encode($result);
    }
}
