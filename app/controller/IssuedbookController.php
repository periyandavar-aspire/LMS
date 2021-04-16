<?php
/**
 * IssuedBookController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * IssuedBookController Class Handles Issued books
 *
 * @category   Controller
 * @package    Controller
 * @subpackage IssuedBookController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

class IssuedBookController extends BaseController
{
    /**
     * Instantiate the new IssuedBookController instance
     */
    public function __construct()
    {
        parent::__construct(new IssuedBookModel(), new IssuedBookService());
    }

    // /**
    //  * Displays the list of issued books with option to add new issue book entry
    //  *
    //  * @return void
    //  */
    // public function manage()
    // {
    //     $user = $this->input->session('type');
    //     $this->loadLayout($user . "Header.html");
    //     $this->loadTemplate('manageIssuedbooks');
    //     $this->loadLayout($user . "Footer.html");
    // }

    /**
     * Displays the list of issued books with the option to add new issue book entry
     *
     * @return void
     */
    public function issue()
    {
        $user = $this->input->session('type');
        $issuedBooks = $this->model->getIssuedBooks();
        $fineSettings = $this->model->getFineConfigs();
        $data['issuedBooks'] = $this->service->calculateFine(
            $issuedBooks,
            $fineSettings
        );
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadTemplate('manageissuedbooks', $data);
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Marks the issued book as returned
     *
     * @param integer $id IssuedBookId
     *
     * @return void
     */
    public function markAsReturn(int $id)
    {
        $result['result'] = $this->model->bookReturned($id);
        echo json_encode($result);
    }

    /**
     * Displays the page to manage user requests
     *
     * @return void
     */
    public function manageUserRequest()
    {
        $user = $this->input->session('type');
        $data['issuedBooks'] = $this->model->getRequestBooks();
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadTemplate('manageUserRequest', $data);
        $this->loadLayout($user . "Footer.html");
        if ($this->input->session('msg') != null) {
            $this->addScript("toast('" . $this->input->session('msg') . "')");
            Utility::setSessionData('msg', null);
        }
    }

    /**
     * Displays the user details of the given username in JSON
     *
     * @param string $username UserName
     *
     * @return void
     */
    public function getUserDetails(string $username)
    {
        $result = $this->model->getUserDetails($username);
        $result->condition = $this->service->checkUserCondition(
            $result,
            $this->model->getMaxBooksToLend()
        );
        echo json_encode($result);
    }

    /**
     * Displays the book details of the given ISBN Number in JSON
     *
     * @param string $isbnNumber IsbnNumber
     *
     * @return void
     */
    public function getBookDetails(string $isbnNumber)
    {
        $result = $this->model->getBookDetails($isbnNumber);
        echo json_encode($result);
    }

    /**
     * Manage the user request
     *
     * @param integer $id RequestId
     *
     * @return void
     */
    public function manageRequest(int $id)
    {
        $user = $this->input->session('type');
        $result = $this->model->getRequestDetails($id);
        $data['user'] = $this->model->getUserDetails($result->userName);
        $data['book'] = $this->model->getBookDetails($result->isbnNumber);
        $data['comments'] = $result->comments;
        $data['id'] = $id;
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadTemplate('userRequest', $data);
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Update the details of the user request
     *
     * @param integer $id requestId
     *
     * @return void
     */
    public function updateRequest(int $id)
    {
        $updateTo = $this->input->post('status');
        $flag = $this->model->updateRequest(
            $id,
            $updateTo,
            $this->input->post(comments)
        );
        $script = $flag == true ? 'Success..!' : 'Failed..!';
        Utility::setSessionData('msg', $script);
        $this->redirect('userRequest');
    }

    /**
     * Adds new issue book entry
     *
     * @return void
     */
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
            if (!$this->service->checkLendCondition(
                $userDetail,
                $bookDetail,
                $maxLendBook,
                $msg
            )
            ) {
                $script = "toast('$msg..!', 'danger')";
            } elseif (!$this->model->addIssuedBook($values)) {
                $script = "toast('The user alredy lend a copy of this book..!'";
                $script .= ",'danger')";
            } else {
                $script = "toast('New Entry Added Successfully..!','success')";
            }
        }
        $issuedBooks = $this->model->getIssuedBooks();
        $fineSettings = $this->model->getFineConfigs();
        $data['issuedBooks'] = $this->service->calculateFine(
            $issuedBooks,
            $fineSettings
        );
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadTemplate("manageissuedbooks", $data);
        $this->loadLayout($user . "Footer.html");
        $this->addScript($script);
    }

    /**
     * Adds new book request by user
     *
     * @param integer $id BookId
     *
     * @return void
     */
    public function request(int $id)
    {
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
