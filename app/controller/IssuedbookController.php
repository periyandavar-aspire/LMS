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
    //     $this->loadView('manageIssuedbooks');
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
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadView('manageissuedbooks');
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
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadView('manageUserRequest');
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
        if ($result == null) {
            Utility::setSessionData('msg', 'Invalid Action');
            $this->redirect('userRequest');
        }
        $result->lent = $this->model->lentBooksCount($result->userId);
        $max = $this->model->getMaxBooksToLend($result->userId);
        if ($max <= $result->lent) {
            $result->msg = "The user almost lent maximum number of books";
        } elseif ($result->available == 0) {
            $result->msg = "Book is currently not available";
        }
        $data['data'] = $result;
        $this->loadLayout($user . "Header.html");
        $this->includeScript("issuedbook.js");
        $this->loadView('userRequest', $data);
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
            $this->input->post('comments')
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
        $this->loadView("manageissuedbooks", $data);
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

    /**
     * Loads Issued books
     *
     * @return void
     */
    public function loadIssuedBook()
    {
        $start = $this->input->get("iDisplayStart");
        $limit = $this->input->get("iDisplayLength");
        $sortby = $this->input->get("iSortCol_0");
        $sortDir = $this->input->get("sSortDir_0");
        $searchKey = $this->input->get("sSearch");
        $tcount = $tfcount = '';
        if ($sortby == 0) {
            $sortby = "ReturnedAt";
            $sortDir = "DESC";
        }
        $issuedBooks = $this->model->getIssuedBooks(
            $start,
            $limit,
            $sortby,
            $sortDir,
            $searchKey,
            $tcount,
            $tfcount
        );
        $fineSettings = $this->model->getFineConfigs();
        $data['aaData'] = $this->service->calculateFine(
            $issuedBooks,
            $fineSettings
        );
        $data["iTotalRecords"] = $tcount;
        $data["iTotalDisplayRecords"] = $tfcount;
        echo json_encode($data);
    }

    /**
     * Loads Request books
     *
     * @return void
     */
    public function loadRequestBook()
    {
        $start = $this->input->get("iDisplayStart");
        $limit = $this->input->get("iDisplayLength");
        $sortby = $this->input->get("iSortCol_0");
        $sortDir = $this->input->get("sSortDir_0");
        $searchKey = $this->input->get("sSearch");
        $tcount = $tfcount = '';
        if ($sortby == 0) {
            $sortby = "RequestedAt";
            $sortDir = "DESC";
        }
        $data['aaData'] = $this->model->getRequestBooks(
            $start,
            $limit,
            $sortby,
            $sortDir,
            $searchKey,
            $tcount,
            $tfcount
        );
        $data["iTotalRecords"] = $tcount;
        $data["iTotalDisplayRecords"] = $tfcount;
        echo json_encode($data);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function samo()
    {
        // $this->load->library("exporter");
        $csv = new Export('pdf');
        $data = $this->model->getRequestBooks();
        $csv->generate($data, "samp", true);
        $csv->send();
    }
}
