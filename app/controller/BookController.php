<?php
class BookController extends BaseController
{
    /**
     * Instantiate a new BookController instance.
     */
    public function __construct()
    {
        parent::__construct(new BookModel());
    }
    
    /**
     * Display all books with CRUD options
     *
     * @return void
     */
    public function manageBooks()
    {
        $user = $this->input->session('type');
        $data['books'] = $this->model->getBooks();
        $this->loadLayout($user . "Header.html");
        $this->loadView("manageBooks", $data);
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
        $this->loadView("newBook", $data);
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Display book details to edit them
     *
     * @param int $id
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
    
    /**
     * Displays the details of the given book $id
     *
     * @param int $id
     * @return void
     */
    public function get(int $id)
    {
        $data['book'] = $this->model->getBookDetails($id);
        $this->loadLayout('header.html');
        $this->loadView("book", $data);
        $this->loadLayout('footer.html');
    }

    /**
     * Handles the search form and return the search result
     *
     * @return void
     */
    public function findBook()
    {
        $user = $this->input->session('type');
        $keyword = $this->input->post('search') ?? '';
        $data['books'] = $this->model->searchBook($keyword);
        $this->loadLayout($user.'header.html');
        $this->loadView("searchBook", $data);
        $this->loadLayout($user.'footer.html');
        $this->includeScript('bookElement.js');
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
        $fields = new Fields(['name', 'location', 'author', 'category', 'publication', 'isbn', 'price', 'stack', 'description']);
        $rules = [
            'author' => 'expressValidation /^[1-9]{1}[0-9,]*$/',
            'category' => 'expressValidation /^[1-9]{1}[0-9,]*$/',
            'isbn' => '',
            'price' => 'positiveNumberValidation',
            'stack' => 'positiveNumberValidation'
        ];
        $fields->addRule($rules);
        $fields->setRequiredFields('name', 'location', 'author', 'category', 'publication', 'isbn', 'price', 'stack', 'description');
        $fields->addValues($this->input->post());
        $fields->renameFieldName('isbn', 'isbnNumber');
        $flag = $fdv->validate($fields, $field);
        if ($flag) {
            $book = $fields->getValues();
            $uploadfile = $this->input->files('coverPic');
            $coverPic = uniqid() . "." . pathinfo($uploadfile['name'], PATHINFO_EXTENSION);
            if ($fields->uploadFile($uploadfile, $coverPic, 'book')) {
                $book['coverPic'] = $coverPic;
                if ($this->model->addBook($book)) {
                    $script = "toast('New book added successfully..!', 'success');";
                } else {
                    $script = "toast('Unable to add new book..!', 'danger');";
                }
            } else {
                $script = "toast('Error occured in file uploading and book not added..!', 'danger');";
            }
        } else {
            $script = "toast('Invalid $field..!', 'danger');";
        }
        $data['books'] = $this->model->getBooks();
        $this->loadLayout($user . "Header.html");
        $this->loadView("newBook", $data);
        $this->loadLayout($user . "Footer.html");
        $this->includeScript("populate.js");
        $this->addScript($script);
    }

    /**
     * Update the status of the book for the book Id $id to status $status
     *
     * @param int $id
     * @param int $status
     * @return void
     */
    public function changeStatus(int $id, int $status)
    {
        $status = func_get_arg(1);
        $values = ['status' => $status];
        $result['result'] = $this->model->updateBook($values, $id);
        echo json_encode($result);
    }

    /**
     * Update the details of the book
     *
     * @param int $id
     * @return void
     */
    public function update(int $id)
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $fields = new Fields(['name', 'location', 'author', 'category', 'publication', 'isbn', 'stack', 'description', 'price']);
        // $rules = [
        //     'fullName' => 'alphaSpaceValidation',
        // ];
        // $fields->addRule($rules);
        $fields->setRequiredFields('name', 'location', 'author', 'category', 'publication', 'isbn', 'stack', 'description', 'price');
        $fields->addValues($this->input->post());
        $fields->renameFieldName('isbn', 'isbnNumber');
        $flag = $fdv->validate($fields, $field);
        if ($flag) {
            $book = $fields->getValues();
            $uploadfile = $this->input->files('coverPic');
            $coverPic = uniqid() . '.' . pathinfo($uploadfile['name'], PATHINFO_EXTENSION);
            if ($fields->uploadFile($uploadfile, $coverPic, 'book')) {
                $book['coverPic'] = $coverPic;
                if ($this->model->update($book, $id)) {
                    $script = "toast('Book updated successfully..!', 'success');";
                } else {
                    $script = "toast('Unable to update the book..!', 'danger');";
                }
            } else {
                $script = "toast('Error occured in file uploading and book not added..!', 'danger');";
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
     * @param int $id
     * @return void
     */
    public function view(int $id)
    {
        $user = $this->input->session('type');
        $data['book'] = $this->model->getBookDetails($id);
        $data['user'] = $user;
        $this->loadLayout($user . 'header.html');
        $this->loadView("bookdetail", $data);
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
     * @param int $id
     * @return [type]
     */
    public function delete(int $id)
    {
        $result['result'] = $this->model->delete($id);
        echo json_encode($result);
    }

    /**
     * Search for a book with given $searchKey
     * 
     * @param string $searchKey
     * @return [type]
     */
    public function search(string $searchKey)
    {
        $result['result'] = $this->model->getBooksLike($searchKey);
        echo json_encode($result);
    }
}
