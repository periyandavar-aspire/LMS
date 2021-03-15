<?php
class HomeController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct(new LoginModel());
    }
    public function index()
    {
        $this->loadView("index");
        // setSessionData("user","user");
    }

    public function captcha()
    {
        $captcha = rand(1000, 9999); 
        setSessionData("captcha",$captcha);
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
        $data = [];
        if ($this->input->post("email") != null) {
            $user = $this->input->post('email');
            $pass = $this->model->getUserPass($user);
            $captcha = $this->input->post("verfcode");
            if ($captcha != $this->input->session("captcha")) {
                $data["msg"] = "Invalid captcha..!";
                $this->loadView("login", $data);
                return;
            }
            if ($pass == md5($this->input->post('password'))) {
                setSessionData("user", "user");
                setSessionData("id", $user);
                $this->redirect("user/home");
            }
            $data["msg"] = "Login failed..!";
        }
        $this->loadView("login", $data);
    }

    public function registration()
    {
        $this->loadView("registration");
    }
}