<?php
/**
 * UserController File Doc Comment
 * php version 7.3.5
 *
 * @category Controller
 * @package  Controller
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * UserController Class Handles the requests by user
 *
 * @category   Controller
 * @package    Controller
 * @subpackage UserController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class UserController extends BaseController
{
    /**
     * Instantiates the new UserController instance
     */
    public function __construct()
    {
        parent::__construct(new UserModel());
    }

    /**
     * Displays the home page for user
     *
     * @return void
     */
    public function home()
    {
        $this->loadLayout("userHeader.html");
        $this->loadTemplate("userHome");
        $this->loadLayout("userFooter.html");
    }

    /**
     * Displays the user profile
     *
     * @return void
     */
    public function profile()
    {
        $this->loadLayout("userHeader.html");
        $id = $this->input->session('id');
        $data['result'] = $this->model->getProfile($id);
        $this->loadTemplate("userProfile", $data);
        $this->loadLayout("userFooter.html");
    }

    /**
     * Updates the user profile
     *
     * @return void
     */
    public function updateProfile()
    {
        $fdv = new FormDataValidation();
        $id = $this->input->session('id');
        $fields = new Fields(['gender', 'mobile', 'fullname']);
        $rules = [
            'fullName' => 'alphaSpaceValidation',
            'mobile' => 'mobileNumberValidation',
        ];
        $fields->addRule($rules);
        $fields->setRequiredFields('gender', 'mobileno', 'fullname');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $msg = "Invalid $field..!";
        } elseif (!$this->model->updateProfile($id, $fields->getValues())) {
            $msg = "toast('Unable to update the profile..!', 'danger');";
        } else {
            $msg = "toast('Profile updated successfully..!', 'success');";
        }
        $password = $this->input->post('password');
        if ($password != '') {
            if (strlen($password) < 6) {
                $msg .= "toast('Your password is too short & not updated..!',";
                $msg .= "'danger');";
            } else {
                if (!$this->model->updatePassword($id, $password)) {
                    $msg .= "toast('Unable to update password..!', 'danger');";
                }
            }
        }
        $data['result'] = $this->model->getProfile($id);
        $this->loadLayout("userHeader.html");
        $this->loadTemplate("userProfile", $data);
        $this->loadLayout("userFooter.html");
        $this->addScript($msg);
    }

    /**
     * Logout the user
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        $this->redirect("login");
    }

    /**
     * Displays the lent books of the user
     *
     * @return void
     */
    public function getLentBooks()
    {
        $user = $this->input->session('id');
        $data["books"] = $this->model->getLentBooks($user);
        $this->loadLayout("userHeader.html");
        $this->loadTemplate("lentBooks", $data);
        $this->loadLayout("userFooter.html");
    }

    /**
     * Displays the books requested by the user
     *
     * @return void
     */
    public function getRequestedBooks()
    {
        $user = $this->input->session('id');
        $data["books"] = $this->model->getRequestedBooks($user);
        $this->loadLayout("userHeader.html");
        $this->loadTemplate("booked", $data);
        $this->loadLayout("userFooter.html");
    }

    /**
     * Removes the user book request
     *
     * @param integer $id userRequestId
     * 
     * @return void
     */
    public function removeRequest(int $id)
    {
        $user = $this->input->session('id');
        $result['result'] = $this->model->removeRequest($id, $user);
        echo json_encode($result);
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
