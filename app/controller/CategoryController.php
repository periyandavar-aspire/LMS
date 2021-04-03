<?php
class CategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new CategoryModel());
    }

    public function getAll()
    {
        $user = $this->input->session('type');
        $data['categories'] = $this->model->getCategories();
        $this->loadLayout($user."Header.html");
        $this->loadView("manageCategories", $data);
        $this->loadLayout($user."Footer.html");
    }
    public function getCategories()
    {
        $result = $this->model->getCategories();
        echo json_encode($result);
    }

    public function add()
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $fields = new Fields(['name']);
        $fields->setRequiredFields('name');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->addCategory($fields->getValues())) {
            $script = "toast('Unable to add new category..!', 'danger');";
        } else {
            $script = "toast('New category is added successfully..!', 'success');";
        }
        $this->loadLayout($user."Header.html");
        $data['categories'] = $this->model->getCategories();
        $this->loadView("manageCategories", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
    }
}
