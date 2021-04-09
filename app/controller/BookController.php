<?php
class BookController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new BookModel());
    }
    
    public function manageBooks()
    {
        $user = $this->input->session('type');
        $data['books'] = $this->model->getBooks();
        $this->loadLayout($user . "Header.html");
        $this->loadView("manageBooks", $data);
        $this->loadLayout($user . "Footer.html");
    }

    public function newBook()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadView("newBook", $data);
        $this->loadLayout($user . "Footer.html");
    }

    public function edit()
    {
        $id = func_get_arg(0);
        $data['book'] = $this->model->get($id);
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadView("newBook", $data);
        $this->loadLayout($user . "Footer.html");
    }

    public function get()
    {
        $id = func_get_arg(0);
        $data['book'] = $this->model->getBookDetails($id);
        $this->loadLayout('header.html');
        $this->loadView("book", $data);
        $this->loadLayout('footer.html');
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
    public function changeStatus()
    {
        $id = func_get_arg(0);
        $status = func_get_arg(1);
        $values = ['status' => $status];
        $result['result'] = $this->model->updateBook($values, $id);
        echo json_encode($result);
    }
    public function update()
    {
        $fdv = new FormDataValidation();
        $id = func_get_arg(0);
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
            if ($fields->uploadFile($uploadfile, $coverPic, 'book')) {
                $book['coverPic'] = $coverPic;
                if ($this->model->update($book)) {
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
        $data['book'] = $this->model->get($id);
        $this->loadLayout($user . "Header.html");
        $this->loadView("newBook", $data);
        $this->loadLayout($user . "Footer.html");
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

    public function delete()
    {
        $id = func_get_arg(0);
        $result['result'] = $this->model->delete($id);
        echo json_encode($result);
    }
}
