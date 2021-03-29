<?php
class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new LoginModel());
    }

    public function login()
    {
        $this->loadView("admin");
    }

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
                Utility::setSessionData("id", $user);
                $this->redirect("admin/home");
            }
        }
        $data["msg"] = "Login failed..!";
        $this->loadView("admin", $data);
    }
}
