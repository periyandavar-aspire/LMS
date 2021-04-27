<?php
/**
 * CategoryController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');

/**
 * CategoryController Class Handles the request related to the categories
 *
 * @category   Controller
 * @package    Controller
 * @subpackage CategoryController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

class CategoryController extends BaseController
{
    /**
     * Instantiate a new CategoryController instance.
     */
    public function __construct()
    {
        parent::__construct(new CategoryModel());
    }

    /**
     * Get and display all the available categories
     *
     * @return void
     */
    public function manage()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user."Header.html");
        $this->loadView("manageCategories");
        $this->loadLayout($user."Footer.html");
    }

    /**
     * Loads categories
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
     * Delete the category and displays the result in JSON
     *
     * @param int $id CategoryId
     *
     * @return void
     */
    public function delete(int $id)
    {
        $result['result'] = $this->model->delete($id);
        echo json_encode($result);
    }

    /**
     * Displays the details of the given categoryId in JSON
     *
     * @param int $id CategoryId
     *
     * @return void
     */
    public function get(int $id)
    {
        $result['data'] = $this->model->get($id);
        echo json_encode($result);
    }

    /**
     * Change the status of the category
     *
     * @param int $id     CategoryID
     * @param int $status StatusId
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
     * Update the details of the category
     *
     * @return void
     */
    public function update()
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $fields = new Fields(['name']);
        $rules = [
            'name' => ['alphaSpaceValidation', 'required']
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
            $script = "toast('Category is updated successfully..!', 'success');";
        }
        $data['categories'] = $this->model->getAll();
        $this->loadLayout($user."Header.html");
        $this->loadView("manageCategories", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
    }

    /**
     * Add a new Category
     *
     * @return void
     */
    public function add()
    {
        $fdv = new FormDataValidation();
        $user = $this->input->session('type');
        $fields = new Fields(['name']);
        $fields->setRequiredFields('name');
        $rules = [
            'name' => 'alphaSpaceValidation',
        ];
        $fields->addRule($rules);
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->add($fields->getValues())) {
            $script = "toast('Unable to add new category..!', 'danger');";
        } else {
            $script = "toast('New category is added successfully..!', 'success');";
        }
        $data['categories'] = $this->model->getAll();
        $this->loadLayout($user."Header.html");
        $this->loadView("manageCategories", $data);
        $this->loadLayout($user."Footer.html");
        $this->addScript($script);
    }

    /**
     * Search for category with given search keys and displays the results in JSON
     *
     * @param string $searchKey  Search keys
     * @param string $ignoreList Category Id list with , as seperator
     *                           which will be ignored during search
     *
     * @return void
     */
    public function search(string $searchKey, string $ignoreList)
    {
        $result['result'] = $this->model->getCategoriesLike($searchKey, $ignoreList);
        echo json_encode($result);
    }
}
