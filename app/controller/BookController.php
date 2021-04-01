<?php
class BookController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new BookModel());
    }
    
    public function getAuthors()
    {
        $result = $this->model->getAuthors();
        echo json_encode($result);
    }
    public function getCategories()
    {
        $result = $this->model->getCategories();
        echo json_encode($result);
    }

    public function manageBooks()
    {
        $user = $this->input->session('type');
        $data['books'] = $this->model->getBooks();
        $this->loadLayout($user . "Header.html");
        $this->loadView("manageBooks", $data);
        $this->loadLayout($user . "Footer.html");
        $this->includeScript("populate.js");
    }


    // public function addBook()
    // {
    //     $fdv = new FormDataValidation();
    //     $fields = new Fields(['name']);
    //     $fields->setRequiredFields('name');
    //     $fields->addValues($this->input->post());
    //     if (!$fdv->validate($fields, $field)) {
    //         $script = "toast('Invalid $field..!', 'danger');";
    //     } elseif (!$this->model->addAuthor($fields->getValues())) {
    //         $script = "toast('Unable to add new author..!', 'danger');";
    //     } else {
    //         $script = "toast('New author is added successfully..!', 'success');";
    //     }
    //     $this->loadLayout("adminHeader.html");
    //     $data['authors'] = $this->model->getAuthors();
    //     $this->loadView("manageAuthors", $data);
    //     $this->loadLayout("adminFooter.html");
    //     $this->addScript($script);
    // }

    public function add()
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $fields = new Fields(['name', 'location', 'author', 'category', 'publication', 'isbn', 'stack', 'description', 'keywords', 'price']);
        // $rules = [
        //     'fullName' => 'alphaSpaceValidation',
        // ];
        // $fields->addRule($rules);
        $fields->setRequiredFields('name', 'location', 'author', 'category', 'publication', 'isbn', 'stack', 'description', 'keywords', 'price');
        $fields->addValues($this->input->post());
        $fields->renameFieldName('isbn', 'isbnNumber');
        $flag = $fdv->validate($fields, $field);
        if ($flag) {
            $book = $fields->getValues();
            $uploadfile = $this->input->files('coverPic');
            $coverPic = uniqid() . pathinfo($uploadfile['name'], PATHINFO_EXTENSION);
            if ($fields->uploadFile($uploadfile, $coverPic, 'books')) {
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
        $this->loadView("manageBooks", $data);
        $this->loadLayout($user . "Footer.html");
        $this->includeScript("populate.js");
        $this->addScript($script);
    }
    public function bookstatus()
    {
        $lastUpdate = filemtime("log/unavailablebooks.log");
        header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream");
        while (true) {
            // if ($lastUpdate != filemtime("log/unavailablebooks.log")) {
            echo "event: $lastUpdate";
            echo "\n\n";
            $data = base64_decode(file_get_contents("log/unavailablebooks.log"));
            echo 'data:'.$data."\n\n";
            // }
            flush();
            sleep(10);
            if (connection_aborted()) {
                break;
            }
        }
    }

    public function available()
    {
        $this->loadLayout("userHeader.html");
        $data['books'] = $this->model->getAvailableBooks();
        $this->loadView("availablebooks", $data);
        $this->loadLayout("userFooter.html");
        $this->includeScript('bookElement.js');
    }
}
