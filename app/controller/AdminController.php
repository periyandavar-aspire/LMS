<?php
/**
 * AdminController File Doc Comment
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
 * AdminController Class Handles the admin functionalities
 *
 * @category   Controller
 * @package    Controller
 * @subpackage AdminController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class AdminController extends BaseController
{
    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        parent::__construct(new AdminModel());
    }

    /**
     * Displays the login page for admin_user
     *
     * @return void
     */
    public function login()
    {
        $this->loadView("admin");
    }

    /**
     * Performs admin_user login
     *
     * @return void
     */
    public function doLogin()
    {
        $user = $this->input->post('email');
        $captcha = $this->input->post("verfcode");
        if ($captcha != $this->input->session("captcha")) {
            $data["msg"] = "Invalid captcha..!";
            $this->loadView("admin", $data);
            return;
        }
        $result = $this->model->getAdminUser($user);
        if ($result != null) {
            if ($result->password == md5($this->input->post('password'))) {
                Utility::setsessionData('login', true);
                Utility::setSessionData("type", $result->type);
                Utility::setSessionData("id", $result->id);
                $this->redirect(strtolower($result->type) . "/home");
            }
        }
        $data["msg"] = "Login failed..!";
        $this->loadView("admin", $data);
    }


    /**
     * Handle the home page request
     *
     * @return void
     */
    public function getHomePage()
    {
        $user = $this->input->session('type');
        $this->loadLayout($user . "Header.html");
        $this->loadView($user. 'home');
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Handle the profile page request
     *
     * @return void
     */
    public function getProfile()
    {
        $user = $this->input->session('type');
        $id = $this->input->session('id');
        $data['result'] = $this->model->getProfile($id);
        $this->loadLayout($user . "Header.html");
        $this->loadView($user . 'Profile', $data);
        $this->loadLayout($user . "Footer.html");
    }

    /**
     * Handle logout request
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        $this->redirect("admin/login");
    }

    /**
     * Update the admin profile
     *
     * @return void
     */
    public function updateProfile()
    {
        $fdv = new FormDataValidation();
        $id = $this->input->session('id');
        $adminId = $this->input->session('id');
        $user = $this->input->session('type');
        $fields = new Fields(['fullname']);
        $rules = [
            'fullName' => 'alphaSpaceValidation',
        ];
        $fields->addRule($rules);
        $fields->setRequiredFields('fullname');
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $msg = "toast('Invalid $field..!', 'danger', 'Invalid Input');";
        } elseif (!$this->model->updateProfile($id, $fields->getValues())) {
            $msg = "toast('Unable to update the profile..!', 'danger',"
                . " 'Failed');";
        } else {
            $msg = "toast('Profile updated successfully..!', 'success');";
            $this->log->activity(
                "Admin user updated his profile with new values "
                . json_encode($fields->getValues()) . ", admin id: '$adminId'"
            );
        }
        $password = $this->input->post('password');
        if ($password != '') {
            if (strlen($password) < 6) {
                $msg .= "toast('Your password is too short & not updated..!',
                         'danger', 'Failed');";
            } else {
                if (!$this->model->updatePassword($id, $password)) {
                    $msg .= "toast('Unable to update password..!', "
                        . "'danger', 'Failed');";
                }
                $this->log->activity(
                    "Admin user updated his password admin id: '$adminId'"
                );
            }
        }
        if (!($data['result'] = $this->model->getProfile($id))) {
            $this->redirect("login");
        }
        $this->loadLayout($user . "Header.html");
        $this->loadView($user . "Profile", $data);
        $this->loadLayout($user . "Footer.html");
        $this->addScript($msg);
    }

    /**
     * Handle the request to the settings page
     *
     * @return void
     */
    public function getSettings()
    {
        $data['data'] = $this->model->getConfigs();
        $this->loadLayout("adminHeader.html");
        $this->loadView("settings", $data);
        $this->loadLayout("adminFooter.html");
    }

    /**
     * Update the settings
     *
     * @return void
     */
    public function updateSettings()
    {
        $fdv = new FormDataValidation();
        $adminId = $this->input->session('id');
        $fields = new Fields(
            ['maxBookLend', 'maxLendDays', 'maxBookRequest', 'fineAmtPerDay']
        );
        $fields->setRequiredFields(
            'maxBookLend',
            'maxLendDays',
            'maxBookRequest',
            'fineAmtPerDay'
        );
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger', 'Invalid Input');";
        } elseif (!$this->model->updateSettings($fields->getValues())) {
            $script = "toast('Unable to update the settings..!', 'danger',"
                . " 'Failed..!');";
        } else {
            $script = "toast('Settings updated successfully..!', 'success');";
            $this->log->activity(
                "Admin user updated lms settings with new values: "
                . json_encode($fields->getValues()) .", admin id: '$adminId'"
            );
        }
        $data['data'] = $this->model->getConfigs();
        $this->loadLayout("adminHeader.html");
        $this->loadView("settings", $data);
        $this->loadLayout("adminFooter.html");
        $this->addScript($script);
    }

    /**
     * Loads the cms contents
     *
     * @return void
     */
    public function getCms()
    {
        $data['data'] = $this->model->getCmsConfigs();
        $this->loadLayout("adminHeader.html");
        $this->loadView("cms", $data);
        $this->loadLayout("adminFooter.html");
    }

    /**
     * Update the cms contents
     *
     * @return void
     */
    public function updateCms()
    {
        $fdv = new FormDataValidation();
        $adminId = $this->input->session('id');
        $fields = [
            'aboutus',
            'address',
            'email',
            'fbUrl',
            'ytUrl',
            'instaUrl',
            'vision',
            'mission'];
        $fields = new Fields($fields);
        $fields->setRequiredFields(
            'aboutus',
            'address',
            'email',
            'fbUrl',
            'ytUrl',
            'instaUrl',
            'vision',
            'mission'
        );
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $script = "toast('Invalid $field..!', 'danger', 'Invalid Input');";
        } elseif (!$this->model->updateCmsConfigs($fields->getValues())) {
            $script = "toast('Unable to update the settings..!', 'danger',"
                . "'Failed..!');";
        } else {
            $script = "toast('Settings updated successfully..!', 'success');";
            $this->log->activity(
                "Admin user updated cms settings with new values "
                . json_encode($fields->getValues()) . ", admin id: '$adminId'"
            );
        }
        $data['data'] = $this->model->getCmsConfigs();
        $this->loadLayout("adminHeader.html");
        $this->loadView("cms", $data);
        $this->loadLayout("adminFooter.html");
        $this->addScript($script);
    }
}
