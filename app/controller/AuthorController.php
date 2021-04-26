<?php
/**
 * AuthorController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Not a valid Request');

/**
 * AuthorController Class Handles the requests related to the authors
 *
 * @category   Controller
 * @package    Controller
 * @subpackage AuthorController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
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
    public function manage()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user."Header.html");
        $this->loadView("manageAuthors");
        $this->loadLayout($user."Footer.html");
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
        $data['aaData'] = $this->model->getAll(
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
        $rules = [
            'name' => 'alphaSpaceValidation',            
        ];
        $fields->addRule($rules);
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->add($fields->getValues())) {
            $script = "toast('Unable to add new author..!', 'danger');";
        } else {
            $script = "toast('New author is added successfully..!', 'success');";
        }
        $data['authors'] = $this->model->getAll();
        $this->loadLayout($user."Header.html");
        $this->loadView("manageAuthors", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
    }

    /**
     * Get the author details by id and display it in JSON format
     *
     * @param int $id AuthorID
     *
     * @return void
     */
    public function get(int $id)
    {
        $result['data'] = $this->model->get($id);
        echo json_encode($result);
    }

    /**
     * Change the status of the author & displays the success/failure message in JSON
     *
     * @param int $id     AuthorID
     * @param int $status StatusID
     *
     * @return void
     */
    public function changeStatus(int $id, int $status)
    {
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
        $rules = [
            'name' => ['alphaSpaceValidation', 'required'],           
        ];
        $fields->addRule($rules);
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->update(
            $fields->getValues(),
            $this->input->post('id')
        )
        ) {
            $script = "toast('Unable to update..!', 'danger');";
        } else {
            $script = "toast('Author is updated successfully..!', 'success');";
        }
        $data['authors'] = $this->model->getAll();
        $this->loadLayout($user."Header.html");
        $this->loadView("manageAuthors", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
    }

    /**
     * Delete the existing author
     *
     * @param int $id AuthorID
     *
     * @return void
     */
    public function delete(int $id)
    {
        $result['result'] = $this->model->delete($id);
        echo json_encode($result);
    }

    /**
     * Search the author with given keys
     *
     * @param string $searchKey  Keys to search
     * @param string $ignoreList The list of authorcodes with , seperator
     *                           to ignore in search
     *
     * @return void
     */
    public function search(string $searchKey, string $ignoreList = '')
    {
        $result['result'] = $this->model->getAuthorsLike($searchKey, $ignoreList);
        echo json_encode($result);
    }
}
