<?php
/**
 * ManageUserController File Doc Comment
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
 * ManageUserController Class allows ys to manage the users
 *
 * @category   Controller
 * @package    Controller
 * @subpackage ManageUserController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class ManageUserController extends BaseController
{
    /**
     * Instantiate the new ManageUserController instance
     */
    public function __construct()
    {
        parent::__construct(new ManageUserModel());
    }

    /**
     * Displays all the available users
     *
     * @return void
     */
    public function manageAllUsers()
    {
        $user = $this->input->session('type');
        $currentUser = $this->input->session('id');
        $this->loadLayout("adminHeader.html");
        $this->loadView("adminManageUsers");
        $this->loadLayout("adminFooter.html");
        $this->includeScript("populate.js");
    }

    /**
     * Loads Regs users
     *
     * @return void
     */
    public function loadRegUser()
    {
        $start = $this->input->get("iDisplayStart", '0');
        $limit = $this->input->get("iDisplayLength", '10');
        $sortby = $this->input->get("iSortCol_0", '0');
        $sortDir = $this->input->get("sSortDir_0", 'ASC');
        $searchKey = $this->input->get("sSearch");
        $tcount = $tfcount = '';
        $data['aaData'] = $this->model->getRegUsers(
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
     * Loads all users
     *
     * @return void
     */
    public function loadAllUser()
    {
        $user = $this->input->session('id');
        $start = $this->input->get("iDisplayStart", '0');
        $limit = $this->input->get("iDisplayLength", '10');
        $sortby = $this->input->get("iSortCol_0", '0');
        $sortDir = $this->input->get("sSortDir_0", 'ASC');
        $searchKey = $this->input->get("sSearch");
        $tcount = $tfcount = '';
        $data['aaData'] = $this->model->getAllUsers(
            $user,
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
     * Displays all the registered users
     *
     * @return void
     */
    public function manageRegUsers()
    {
        $user = $this->input->session('type');
        $currentUser = $this->input->session('id');
        $this->loadLayout("librarianHeader.html");
        $this->loadView("librarianManageUsers");
        $this->loadLayout("librarianFooter.html");
    }

    /**
     * Displays the roles of the user in JSON
     *
     * @return void
     */
    public function getUserRoles()
    {
        $result = $this->model->getAllRoles();
        echo json_encode($result);
    }

    /**
     * Deletes the user
     *
     * @param string  $role User role
     * @param integer $id   User Id
     *
     * @return void
     */
    public function delete(string $role, int $id)
    {
        $result['result'] = $this->model->delete($role, $id, $msg);
        $result['msg'] = $msg;
        echo json_encode($result);
    }

    /**
     * Creates a new admin_user account
     *
     * @return void
     */
    public function addUser()
    {
        $fdv = new FormDataValidation();
        $fields = new Fields(['fullName', 'email', 'role', 'password']);
        $roleCodes = implode(" ", $this->model->getRoleCodes());
        $rules = [
            'email' => ['emailValidation', 'required'],
            'fullname' => ['alphaSpaceValidation', 'required'],
            'password' => ["lengthValidation 6", 'required'],
            'role' => ["valuesInValidation $roleCodes", 'required']
        ];
        $fields->addRule($rules);
        $fields->setRequiredFields('fullName', 'email', 'role', 'password');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger');";
        } elseif (!$this->model->addAdminUser($fields->getValues())) {
            $script = "toast('Unable to add new user..!', 'danger');";
        } else {
            $script = "toast('New user added successfully..!', 'success');";
        }
        $currentUser = $this->input->session('id');
        $data['users'] = $this->model->getAllUsers($currentUser);
        $this->loadLayout("adminHeader.html");
        $this->loadView("adminmanageUsers", $data);
        $this->loadLayout("adminFooter.html");
        $this->includeScript("populate.js");
        $this->addScript($script);
    }

    /**
     * Search for the user with the given search key
     *
     * @param string $searchKey Search keys
     *
     * @return void
     */
    public function search(string $searchKey)
    {
        $result['result'] = $this->model->getUsersLike($searchKey);
        echo json_encode($result);
    }
}
