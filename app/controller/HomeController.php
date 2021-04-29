<?php
/**
 * HomeController File Doc Comment
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
 * HomeController Class Handles all the request to the home page
 *
 * @category   Controller
 * @package    Controller
 * @subpackage HomeController
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

class HomeController extends BaseController
{
    /**
     * Instantiate the new HomeController Instance
     */
    public function __construct()
    {
        parent::__construct(new HomeModel());
    }

    /**
     * Displays the index page of the website
     *
     * @return void
     */
    public function getIndexPage()
    {
        $homeData['vision'] = $this->model->getVision();
        $homeData['mission'] = $this->model->getMission();
        $homeData['books'] = $this->model->getAvailableBooks();
        $data['footer'] = $this->model->getFooterData();
        $this->loadLayout("header.html");
        $this->loadView("index", $homeData);
        $this->loadView("footer", $data);
        $this->includeScript('bookElement.js');
    }

    /**
     * Displays the available books
     *
     * @return void
     */
    public function getBooks()
    {
        $books['books'] = $this->model->getAvailableBooks();
        $data['footer'] = $this->model->getFooterData();
        $this->loadLayout("header.html");
        $this->loadView("books", $books);
        $this->loadView("footer", $data);
        $this->includeScript('bookElement.js');
    }

    /**
     * Displays aboutus page
     *
     * @return void
     */
    public function getAboutus()
    {
        $data['footer'] = $this->model->getFooterData();
        $this->loadLayout("header.html");
        $this->loadView("aboutus", ["aboutUs" => $data['footer']->aboutUs]);
        $this->loadView("footer", $data);
    }

    /**
     * Generates captcha
     *
     * @return void
     */
    public function createCaptcha()
    {
        $this->load->library('captcha');
        $captcha = $this->captcha->generate();
        Utility::setSessionData("captcha", $captcha);
        $this->captcha->show();
    }

    /**
     * Displays login page
     *
     * @return void
     */
    public function login()
    {
        $data['footer'] = $this->model->getFooterData();
        $this->loadLayout("header.html");
        $this->loadView("login");
        $this->loadView("footer", $data);
        if ($this->input->session('msg') != null) {
            $this->addScript($this->input->session('msg'));
            Utility::setSessionData('msg', null);
        }
    }

    /**
     * Performs user login
     *
     * @return void
     */
    public function dologin()
    {
        $data = [];
        $username = $this->input->post('username');
        $fdv = new FormDataValidation();
        $fields = new fields(['username', 'captcha']);
        $fields->addRule(
            [
            'username' => [
                "expressValidation /^[A-Za-z0-9_]*$/",
                'required'
                ]
            ]
        );
        $fields->addCustomeRule(
            'captcha',
            new class() implements ValidationRule {
                /**
                 * Validates the captcha
                 *
                 * @param string $data data to be validated
                 * @param string $msg  where the error msg will be stored
                 *
                 * @return boolean|null
                 */
                public function validate(string $data, ?string &$msg = null): ?bool
                {
                    if ($data == (new InputData())->session("captcha")) {
                        return true;
                    } else {
                        $msg = "Invalid captcha";
                        return false;
                    }
                }
            }
        );
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $data["msg"] = "Invalid $field..!";
        } else {
            $user = $this->model->getUser($username);
            if (isset($user)
                && $user->password == md5($this->input->post('password'))
            ) {
                Utility::setsessionData('login', VALID_LOGIN);
                Utility::setSessionData("type", REG_USER);
                Utility::setSessionData("id", $user->id);
                $this->redirect("home");
            } else {
                $data["msg"] = "Login failed..!";
            }
        }
        $data['footer'] = $this->model->getFooterData();
        $this->loadLayout("header.html");
        $this->loadView("login", $data);
        $this->loadView("footer", $data);
    }

    /**
     * Creates an account for the user
     *
     * @return void
     */
    public function createAccount()
    {
        $data = [];
        $fdv = new FormDataValidation();
        $genCodes = implode(" ", $this->model->getGenderCodes());
        $fields = new fields(
            [
                'email',
                'username',
                'fullname',
                'password',
                'gender',
                'mobile'
            ]
        );
        $rules = [
            'email' => ['emailValidation', 'required'],
            'fullname' => ['alphaSpaceValidation', 'required'],
            'username' => ["expressValidation /^[A-Za-z0-9_]*$/", 'required'],
            'password' => ["lengthValidation 6", 'required'],
            'mobile' => ['mobileNumberValidation', 'required'],
            'gender' => ["valuesInValidation $genCodes", 'required']
        ];
        $fields->addRule($rules);
        $fields->addValues($this->input->post());
        $data['footer'] = $this->model->getFooterData();
        if ($this->input->post('captcha') != (new InputData())->session("captcha")) {
            $data["msg"] = "Invalid captcha..!";
        } elseif (!$fdv->validate($fields, $field)) {
            $data["msg"] = "Invalid $field..!";
        } elseif (!$this->model->createAccount($fields->getValues())) {
            $data["msg"] = "Unable to create an account..!";
        } else {
            $msg = "toast('Your Account is created successfully..!', 'success');";
            Utility::setsessionData('msg', $msg);
            $this->redirect('login');
            $this->log->activity(
                "A new account created with values "
                . json_encode($fields->getValues())
            );
            return;
        }
        $data['dropdownGen'] = $this->model->getGender();
        $this->loadLayout("header.html");
        $this->loadView("registration", $data);
        $this->loadView("footer", $data);
    }

    /**
     * Displays the registration page
     *
     * @return void
     */
    public function registration()
    {
        $data['dropdownGen'] = $this->model->getGender();
        $data['footer'] = $this->model->getFooterData();
        $this->loadLayout("header.html");
        $this->loadView("registration", $data);
        $this->loadView("footer", $data);
    }
}
