<?php
/**
 * Handles the request related to author
 */
class AuthorController extends BaseController
{
    /**
     * Instantiate a new AuthorController instance.
     */
    public function __construct()
    {
        parent::__construct(new AuthorModel());
    }

    /**
     * Displays all authors request
     *
     * @return void
     */
    public function getAll()
    {
        $data['authors'] = $this->model->getAll();
        $user = $this->input->session('type');
        $this->loadLayout($user."Header.html");
        $this->loadView("manageAuthors", $data);
        $this->loadLayout($user."Footer.html");
    }
    
    /**
     * Add new author and display available authors
     *
     * @return void
     */
    public function add()
    {
        $fdv = new FormDataValidation();
        $fields = new Fields(['name']);
        $user = $this->input->session('type');
        $fields->setRequiredFields('name');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->add($fields->getValues())) {
            $script = "toast('Unable to add new author..!', 'danger');";
        } else {
            $script = "toast('New author is added successfully..!', 'success');";
        }
        $this->loadLayout($user."Header.html");
        $data['authors'] = $this->model->getAll();
        $this->loadView("manageAuthors", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
    }
    
    /**
     * Get the author details by id and display it in JSON format
     *
     * @param integer $id
     * @return void
     */
    public function get(int $id)
    {
        $result['data'] = $this->model->get($id);
        echo json_encode($result);
    }
    
    /**
     * Change the status of the author and display the success/failure message in JSON
     *
     * @param integer $id
     * @param integer $status
     * @return void
     */
    public function changeStatus(int $id, int $status)
    {
        $id = func_get_arg(0);
        $status = func_get_arg(1);
        $values = ['status' => $status];
        $result['result'] = $this->model->update($values, $id);
        echo json_encode($result);
    }

    /**
     * Update the author details
     *
     * @return void
     */
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
            $script = "toast('Author is updated successfully..!', 'success');";
        }
        $this->loadLayout($user."Header.html");
        $data['authors'] = $this->model->getAll();
        $this->loadView("manageAuthors", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
    }

    /**
     * Delete the existing author
     *
     * @return void
     */
    public function delete()
    {
        $id = func_get_arg(0);
        $result['result'] = $this->model->delete($id);
        echo json_encode($result);
    }

    /**
     * Search the author with given keys in $searchKey and ignore the author if his id is in $ignoreList
     *
     * @param integer $searchKey
     * @param string $ignoreList
     * @return void
     */
    public function search(int $searchKey, string $ignoreList = '')
    {
        $result['result'] = $this->model->getAuthorsLike($searchKey, $ignoreList);
        echo json_encode($result);
    }
}
