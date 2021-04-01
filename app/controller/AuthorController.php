<?php
class AuthorController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new AuthorModel());
    }
    public function getAll()
    {
        $data['authors'] = $this->model->getAuthors();
        $this->loadLayout("adminHeader.html");
        $this->loadView("manageAuthors", $data);
        $this->loadLayout("adminFooter.html");
    }

    public function add()
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
        $this->loadLayout("adminHeader.html");
        $data['authors'] = $this->model->getAuthors();
        $this->loadView("manageAuthors", $data);
        $this->loadLayout("adminFooter.html");
        $this->addScript($script);
    }
}
