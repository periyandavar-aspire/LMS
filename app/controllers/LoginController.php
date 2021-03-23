<?php
class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function adminLogin()
    {
        $user = $this->input->post('email');
        $pass = $this->model->getAdminPass($user);
        $captcha = $this->input->post("verfcode");
        if ($captcha != $this->input->session("captcha")) {
            $data["msg"] = "Invalid captcha..!";
            $this->loadView("admin", $data);
            return;
        }
        if ($pass == md5($this->input->post('password'))) {
            setSessionData("user", "admin");
            setSessionData("id", $user);
            $this->redirect("user/home");
        }
        $data["msg"] = "Login failed..!";
        $this->loadView("admin", $data);
    }


    public function librarianLogin()
    {
        $user = $this->input->post('email');
        $pass = $this->model->getLibrarianPass($user);
        $captcha = $this->input->post("verfcode");
        if ($captcha != $this->input->session("captcha")) {
            $data["msg"] = "Invalid captcha..!";
            $this->loadView("librarian", $data);
            return;
        }
        if ($pass == md5($this->input->post('password'))) {
            setSessionData("user", "librarian");
            setSessionData("id", $user);
            $this->redirect("user/home");
        }
        $data["msg"] = "Login failed..!";
        $this->loadView("librarian", $data);
    }

    public function admin()
    {
        $this->loadView("admin");
    }

    public function librarian()
    {
        $this->loadView("librarian");
    }
}