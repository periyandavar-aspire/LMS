<?php
/**
 * BookController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');
/**
 * BookController Class Handles the requests related to the Books
 *
 * @category   Controller
 * @package    Controller
 * @subpackage BookController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class BookController extends BaseController
{
    /**
     * Instantiate a new BookController instance.
     */
    public function __construct()
    {
        parent::__construct(new BookModel(), new BookService());
    }

    /**
     * Display all books with CRUD options
     *
     * @return void
     */
    public function manageBooks()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadView("manageBooks");
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Adds a new book
     *
     * @return void
     */
    public function newBook()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadView("newBook");
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Display book details to edit them
     *
     * @param int $id BookID
     *
     * @return void
     */
    public function getToEdit(int $id)
    {
        $data['book'] = $this->model->get($id);
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadView("newBook", $data);
        $this->loadLayout($user . "Footer.html");
    }

    // /**
    //  * Displays the details of the given book $id
    //  *
    //  * @param int $id BookID
    //  *
    //  * @return void
    //  */
    // public function get(int $id)
    // {
    //     $data['book'] = $this->model->getBookDetails($id);
    //     $this->loadLayout('header.html');
    //     $this->loadView("book", $data);
    //     $this->loadLayout('footer.html');
    // }

    /**
     * Handles the search form and return the search result
     *
     * @return void
     */
    public function findBook()
    {
        $user = $this->input->session('type');
        $keyword = $this->input->get('search') ?? '';
        $data['books'] = $this->model->searchBook($keyword);
        $data['searchKey'] = $keyword;
        $this->loadLayout($user.'header.html');
        $this->loadView("searchBook", $data);
        $this->loadLayout($user.'footer.html');
        $this->includeScript('bookElement.js');
    }


    /**
     * Displays the books requested by the user
     *
     * @param int $offset Offset
     * @param int $limit  Limit
     *
     * @return void
     */
    public function loadBooks(
        int $offset = 0,
        int $limit = 5
    ) {
        $data["books"] = $this->model->getAvailableBooks(
            $offset,
            $limit,
            $search
        );
        echo json_encode($data);
    }

    /**
     * Displays the books requested by the user
     *
     * @param string $search Search Key
     * @param int    $offset Offset
     * @param int    $limit  Limit
     *
     * @return void
     */
    public function findMoreBooks(
        string $search,
        int $offset = 0,
        int $limit = 12
    ) {
        $data["books"] = $this->model->searchBook(
            $search,
            $offset,
            $limit
        );
        echo json_encode($data);
    }


    /**
     * Add a new book
     *
     * @return void
     */
    public function add()
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $inputFields = [
            'name',
            'location',
            'author',
            'category',
            'publication',
            'isbn',
            'price',
            'stack',
            'description'
        ];
        $fields = new Fields($inputFields);
        $rules = [
            'author' => 'expressValidation /^[1-9]{1}[0-9,]*$/',
            'category' => 'expressValidation /^[1-9]{1}[0-9,]*$/',
            'isbn' => '',
            'price' => 'positiveNumberValidation',
            'stack' => 'positiveNumberValidation'
        ];
        $fields->addRule($rules);
        $fields->setRequiredFields(...$inputFields);
        $fields->addValues($this->input->post());
        $fields->renameFieldName('isbn', 'isbnNumber');
        $flag = $fdv->validate($fields, $field);
        if ($flag) {
            $book = $fields->getValues();
            $uploadfile = $this->input->files('coverPic');
            $coverPic = uniqid() . "." . pathinfo(
                $uploadfile['name'],
                PATHINFO_EXTENSION
            );
            if ($fields->uploadFile($uploadfile, $coverPic, 'book')) {
                $book['coverPic'] = $coverPic;
                if ($this->model->addBook($book)) {
                    $script = "toast('New book added successfully..!', 'success');";
                    $data['books'] = $this->model->getBooks();
                    $this->loadLayout($user . "Header.html");
                    $this->loadView("manageBooks", $data);
                    $this->loadLayout($user . "Footer.html");
                    $this->addScript($script);
                    return;
                } else {
                    $script = "toast('Unable to add new book..!', 'danger');";
                }
            } else {
                $script = "toast('Error occured in file uploading";
                $script .= "and book not added..!', 'danger');";
            }
        } else {
            $script = "toast('Invalid $field..!', 'danger');";
        }
        $this->loadLayout($user . "Header.html");
        $this->loadView("newBook");
        $this->loadLayout($user . "Footer.html");
        // $this->includeScript("populate.js");
        $this->addScript($script);
    }

    /**
     * Loads Authors
     *
     * @return void
     */
    public function load()
    {
        $start = $this->input->get("iDisplayStart");
        $limit = $this->input->get("iDisplayLength");
        $sortby = $this->input->get("iSortCol_0");
        $sortDir = $this->input->get("sSortDir_0");
        $searchKey = $this->input->get("sSearch");
        $data['aaData'] = $this->model->getBooks(
            $start,
            $limit,
            $sortby+1,
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
     * Update the status of the book for the book Id $id to status $status
     *
     * @param int $id     BookID
     * @param int $status StatusId
     *
     * @return void
     */
    public function changeStatus(int $id, int $status)
    {
        $values = ['status' => $status];
        $result['result'] = $this->model->updateBook($values, $id);
        echo json_encode($result);
    }

    /**
     * Update the details of the book
     *
     * @param int $id BookID
     *
     * @return void
     */
    public function update(int $id)
    {
        global $config;
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $inputFields = [
            'name',
            'location',
            'author',
            'category',
            'publication',
            'isbn',
            'stack',
            'description',
            'price'
        ];
        $fields = new Fields($inputFields);
        $rules = [
            'author' => 'expressValidation /^[1-9]{1}[0-9,]*$/',
            'category' => 'expressValidation /^[1-9]{1}[0-9,]*$/',
            'isbn' => '',
            'price' => 'positiveNumberValidation',
            'stack' => 'positiveNumberValidation'
        ];
        $fields->addRule($rules);
        $fields->setRequiredFields(...$inputFields);
        $fields->addValues($this->input->post());
        $fields->renameFieldName('isbn', 'isbnNumber');
        $flag = $fdv->validate($fields, $field);
        if ($flag) {
            $book = $fields->getValues();
            $uploadfile = $this->input->files('coverPic');
            if ($uploadfile['error'] == 0) {
                $coverPic = uniqid() . '.' . pathinfo(
                    $uploadfile['name'],
                    PATHINFO_EXTENSION
                );
                $flag = $fields->uploadFile($uploadfile, $coverPic, 'book');
                $book['coverPic'] = $coverPic;
            }
            if ($flag) {
                $oldPic = $this->model->getCoverPic($id);
                if ($this->model->update($book, $id)) {
                    $script = "toast('Book updated successfully..!', 'success');";
                    if (isset($book['coverPic'])) {
                        unlink(
                            $config['upload']
                            . '/'
                            . COVER_PIC_PATH
                            . $oldPic
                        );
                    }
                } else {
                    $script = "toast('Unable to update the book..!', 'danger');";
                }
            } else {
                $script = "toast('Error in file uploading and book not added..!',";
                $script .= "'danger');";
            }
        } else {
            $script = "toast('Invalid $field..!', 'danger');";
        }
        $data['books'] = $this->model->getBooks();
        $data['book'] = $this->model->get($id);
        $this->loadLayout($user . "Header.html");
        $this->loadView("newBook", $data);
        $this->loadLayout($user . "Footer.html");
        $this->addScript($script);
    }


    // public function bookstatus()
    // {
    //     $lastUpdate = filemtime("log/unavailablebooks.log");
    //     header("Cache-Control: no-cache");
    //     header("Content-Type: text/event-stream");
    //     while (true) {
    //         // if ($lastUpdate != filemtime("log/unavailablebooks.log")) {
    //         echo "event: $lastUpdate";
    //         echo "\n\n";
    //         $data = base64_decode(file_get_contents("log/unavailablebooks.log"));
    //         echo 'data:'.$data."\n\n";
    //         // }
    //         flush();
    //         sleep(10);
    //         if (connection_aborted()) {
    //             break;
    //         }
    //     }
    // }

    /**
     * Display the details of the single book
     *
     * @param int $id BookID
     *
     * @return void
     */
    public function view(int $id)
    {
        $user = $this->input->session('type');
        $data['book'] = $this->model->getBookDetails($id);
        $data['user'] = $user;
        if ($user != 'User') {
            $issuedData = $this->model->getIssuedUsers($id);
            $data['issuedUsers'] = $this->service->seperateUsers($issuedData);
        }
        $template = ($user == null) ? 'book' : 'bookdetail';
        $this->loadLayout($user . 'header.html');
        $this->loadView($template, $data);
        $this->loadLayout($user . 'footer.html');
    }

    /**
     * Displays all the available books to the user
     *
     * @return void
     */
    public function getAvailableBooks()
    {
        $this->loadLayout("userHeader.html");
        $data['books'] = $this->model->getAvailableBooks();
        $this->loadView("availablebooks", $data);
        $this->loadLayout("userFooter.html");
        $this->includeScript('bookElement.js');
    }

    /**
     * Delete the book
     *
     * @param int $id BookId
     *
     * @return void
     */
    public function delete(int $id)
    {
        $result['result'] = $this->model->delete($id, $msg);
        $result['msg'] = $msg;
        echo json_encode($result);
    }

    /**
     * Search for a book with given $searchKey
     *
     * @param string $searchKey Search keys as string
     *
     * @return void
     */
    public function search(string $searchKey)
    {
        $result['result'] = $this->model->getBooksLike($searchKey);
        echo json_encode($result);
    }
}
