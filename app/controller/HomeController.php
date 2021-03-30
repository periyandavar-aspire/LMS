<?php
class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new HomeModel());
    }
    public function index()
    {
        $this->loadLayout("header.html");
        $homeData['vision'] = $this->model->getVision();
        $homeData['mission'] = $this->model->getMission();
        $this->loadView("index", $homeData);
        $data['footer'] = $this->model->getFooterData();
        $this->loadView("footer", $data);
    }

    public function home()
    {
        $this->model->getData();
    }

    public function books()
    {
        $this->loadLayout("header.html");
        $books['books'] = $this->model->getBooks();
        $this->loadView("books", $books);
        $data['footer'] = $this->model->getFooterData();
        $this->loadView("footer", $data);
    }
    public function aboutus()
    {
        $this->loadLayout("header.html");
        $data['footer'] = $this->model->getFooterData();
        $this->loadView("aboutus", ["aboutUs" => $data['footer']->aboutUs]);
        $this->loadView("footer", $data);
    }
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

    public function login()
    {
        $this->loadLayout("header.html");
        $this->loadView("login");
        $data['footer'] = $this->model->getFooterData();
        $this->loadView("footer", $data);
    }

    public function dologin()
    {
        $data = [];
        $username = $this->input->post('username');
        $fdv = new FormDataValidation();
        $fields = new fields(['username', 'captcha']);
        $fields->addRule(['username' => "expressValidation /^[A-Za-z0-9_]*$/"]);
        $fields->addCustomeRule(
            'captcha',
            new class implements ValidationRule {
                public function validate(?string $data): ?bool
                {
                    return $data == (new InputData())->session("captcha") ? true : false;
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
        $this->loadView("login", $data);
        $data['footer'] = $this->model->getFooterData();
        $this->loadView("footer", $data);
    }
    public function createAccount()
    {
        $data = [];
        $fdv = new FormDataValidation();
        $genCodes = implode(" ", $this->model->getGenderCodes());
        $fields = new fields(['email', 'username', 'fullname', 'password', 'gender', 'mobile']);
        $rules = [
            'email' => 'mailValidation',
            'fullName' => 'alphaSpaceValidation',
            'username' => "expressValidation /^[A-Za-z0-9_]*$/",
            'password' => "lengthValidation 6",
            'mobile' => 'mobileNumberValidation',
            'gender' => "valuesInValidation $genCodes"
        ];
        $fields->addRule($rules);
        // $fields->addCustomeRule(
        //     'gender',
        //     new class implements ValidationRule {
        //         public function validate(?string $data): ?bool
        //         {
        //             if ($data == 'm' || $data == 'f') {
        //                 return true;
        //             } else {
        //                 return false;
        //             }
        //         }
        //     }
        // );
        $fields->addValues($this->input->post());
        if ($this->input->post('captcha') != (new InputData())->session("captcha")) {
            $data["msg"] = "Invalid captcha..!";
        } elseif (!$fdv->validate($fields, $field)) {
            $data["msg"] = "Invalid $field..!";
        } elseif (!$this->model->createAccount($fields->getValues())) {
            $data["msg"] = "Unable to create an account..!";
        } else {
            $this->loadLayout("header.html");
            $this->loadView("login");
            $this->loadView("footer");
            $this->addScript("toast('Your Account is created successfully..!', 'success');");
            return;
        }
        $this->loadLayout("header.html");
        $data['dropdownGen'] = $this->model->getGender();
        $this->loadView("registration", $data);
        $data['footer'] = $this->model->getFooterData();
        $this->loadView("footer", $data);
    }
    public function registration()
    {
        $this->loadLayout("header.html");
        $data['dropdownGen'] = $this->model->getGender();
        $this->loadView("registration", $data);
        $data['footer'] = $this->model->getFooterData();
        $this->loadView("footer", $data);
    }
}
