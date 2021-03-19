<?php
class HomeController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct(new HomeModel());
    }
    public function index()
    {
        $this->loadLayout("header.html");
        $this->loadView("index");
        $this->loadLayout("footer.html");
        // setSessionData("user","user");
    }

    public function home()
    {
        // $this->index();
        $this->model->getData();
    }

    public function books()
    {
        $this->loadLayout("header.html");
        $this->loadView("books");
        $this->loadLayout("footer.html");
    }
    public function aboutus()
    {
        $this->loadLayout("header.html");
        $this->loadView("aboutus");
        $this->loadLayout("footer.html");
    }
    public function captcha()
    {
        $captcha = rand(1000, 9999); 
        Utility::setSessionData("captcha",$captcha);
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
        $this->loadLayout("footer.html");
    }

    public function dologin()
    {
        $data = [];
        $user = $this->input->post('email');
        $fdv = new FormDataValidation();
        $fields = new fields(['email', 'captcha']);
        $fields->addRule(['email' => "mailValidation"]);
        $fields->addCustomeRule(
            'captcha',
            new class implements ValidationRule {
                public function validate(?string $data): ?bool
                {
                    $flag = $data == (new InputData())->session("captcha");
                    return $flag;
                }
            }
        );
        $fields->addValues($this->input->post());
        if (!$fdv->validate($fields, $field)) {
            $data["msg"] = "Invalid $field..!";
        } else {
            $pass = $this->model->getUserPass($user);
            if ($pass == md5($this->input->post('password'))) {
                Utility::setSessionData("user", "user");
                Utility::setSessionData("id", $user);
                $this->redirect("user/home");
            } else {
                $data["msg"] = "Login failed..!";
            }
        }
        $this->loadLayout("header.html");
        $this->loadView("login", $data);
        $this->loadLayout("footer.html");
    }
    public function registration()
    {
        $this->loadLayout("header.html");
        $this->loadView("registration");
        $this->loadLayout("footer.html");
    }
}