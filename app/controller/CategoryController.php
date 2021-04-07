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
        $data['categories'] = $this->model->getAll();
        $this->loadLayout($user."Header.html");
        $this->loadView("manageCategories", $data);
        $this->loadLayout($user."Footer.html");
    }
    public function delete()
    {
        $id = func_get_arg(0);
        $result['result'] = $this->model->delete($id);
        echo json_encode($result);
    }
    public function get()
    {
        $id = func_get_arg(0);
        $result['data'] = $this->model->get($id);
        echo json_encode($result);
    }
    public function update()
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $fields = new Fields(['name']);
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger);";
        } elseif (!$this->model->update($fields->getValues(), $this->input->post('id'))) {
            $script = "toast('Unable to update..!', 'danger');";
        } else {
            $script = "toast('Category is updated successfully..!', 'success');";
        }
        $this->loadLayout($user."Header.html");
        $data['categories'] = $this->model->getAll();
        $this->loadView("manageCategories", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
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
        } elseif (!$this->model->add($fields->getValues())) {
            $script = "toast('Unable to add new category..!', 'danger');";
        } else {
            $script = "toast('New category is added successfully..!', 'success');";
        }
        $this->loadLayout($user."Header.html");
        $data['categories'] = $this->model->getAll();
        $this->loadView("manageCategories", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
    }
}
