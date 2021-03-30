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
        $data['books'] = $this->model->getBooks();
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageBooks", $data);
        $this->loadLayout("adminFooter.html");
        $this->includeScript("book.js");
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
            $coverPic = $book['name'] . uniqid() . '.jpg';
            if ($fields->uploadFile($this->input->files('coverPic'), $coverPic, 'books')) {
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
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageBooks", $data);
        $this->loadLayout("adminFooter.html");
        $this->includeScript("book.js");
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
}
