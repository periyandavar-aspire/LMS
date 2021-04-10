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
    public function changeStatus()
    {
        $id = func_get_arg(0);
        $status = func_get_arg(1);
        $values = ['status' => $status];
        $result['result'] = $this->model->update($values, $id);
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

    public function search()
    {
        $searchKey = func_get_arg(0);
        $ignoreList = func_get_arg(1);
        $result['result'] = $this->model->getCategoriesLike($searchKey, $ignoreList);
        echo json_encode($result);
    }
}
