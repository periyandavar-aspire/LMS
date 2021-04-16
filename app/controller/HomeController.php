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
        $this->loadLayout("header.html");
        $homeData['vision'] = $this->model->getVision();
        $homeData['mission'] = $this->model->getMission();
        $homeData['books'] = $this->model->getAvailableBooks();
        // $this->loadTemplate("index", $homeData);
        $this->setView(new HomeView());
        $this->view->loadIndexPage($homeData);
        $data['footer'] = $this->model->getFooterData();
        $this->loadTemplate("footer", $data);
        $this->includeScript('bookElement.js');
    }

    /**
     * Displays the available books
     *
     * @return void
     */
    public function books()
    {
        $this->loadLayout("header.html");
        $books['books'] = $this->model->getAvailableBooks();
        $this->loadTemplate("books", $books);
        $data['footer'] = $this->model->getFooterData();
        $this->loadTemplate("footer", $data);
        $this->includeScript('bookElement.js');
    }

    /**
     * Displays aboutus page
     *
     * @return void
     */
    public function aboutus()
    {
        $this->loadLayout("header.html");
        $data['footer'] = $this->model->getFooterData();
        $this->loadTemplate("aboutus", ["aboutUs" => $data['footer']->aboutUs]);
        $this->loadTemplate("footer", $data);
    }

    /**
     * Generates captcha
     *
     * @return void
     */
    public function captcha()
    {
        $captcha = rand(1000, 9999);
        Utility::setSessionData("captcha", $captcha);
        $height = 25;
        $width = 65;
        $image = imagecreate($width, $height);
        imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $font_size = 14;
        imagestring($image, $font_size, 5, 5, $captcha, $white);
        imagejpeg($image, null, 80);
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header('Content-type: image/jpg');
        imagedestroy($image);
    }

    /**
     * Displays login page
     *
     * @return void
     */
    public function login()
    {
        $this->loadLayout("header.html");
        $this->loadTemplate("login");
        $data['footer'] = $this->model->getFooterData();
        $this->loadTemplate("footer", $data);
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
            $pass = $this->model->getUserPass($username);
            if ($pass == md5($this->input->post('password'))) {
                Utility::setsessionData('login', true);
                Utility::setSessionData("type", "user");
                Utility::setSessionData("id", $username);
                $this->redirect("user/home");
            } else {
                $data["msg"] = "Login failed..!";
            }
        }
        $this->loadLayout("header.html");
        $this->loadTemplate("login", $data);
        $data['footer'] = $this->model->getFooterData();
        $this->loadTemplate("footer", $data);
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
            'email' => ['mailValidation', 'required'],
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
            $this->loadLayout("header.html");
            $this->loadTemplate("login");
            $this->loadTemplate("footer", $data);
            $this->addScript(
                "toast('Your Account is created successfully..!', 'success');"
            );
            return;
        }
        $this->loadLayout("header.html");
        $data['dropdownGen'] = $this->model->getGender();
        $this->loadTemplate("registration", $data);
        $this->loadTemplate("footer", $data);
    }

    /**
     * Displays the registration page
     *
     * @return void
     */
    public function registration()
    {
        $this->loadLayout("header.html");
        $data['dropdownGen'] = $this->model->getGender();
        $this->loadTemplate("registration", $data);
        $data['footer'] = $this->model->getFooterData();
        $this->loadTemplate("footer", $data);
    }
}
