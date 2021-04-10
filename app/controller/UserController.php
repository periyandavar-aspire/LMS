<?php
class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new UserModel());
    }
    
    public function home()
    {
        // $model = func_get_args()[0] ?? null;
        // $obj = static::getMyInstance($model);
        $this->loadLayout("userHeader.html");
        $this->loadView("userHome");
        $this->loadLayout("userFooter.html");
    }

    public function profile()
    {
        $this->loadLayout("userHeader.html");
        $id = $this->input->session('id');
        $data['result'] = $this->model->getProfile($id);
        $this->loadView("userProfile", $data);
        $this->loadLayout("userFooter.html");
    }

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
                $msg .= "toast('Your password is too short & not updated..!', 'danger');";
            } else {
                if (!$this->model->updatePassword($id, $password)) {
                    $msg .= "toast('Unable to update password..!', 'danger');";
                }
            }
        }
        $data['result'] = $this->model->getProfile($id);
        $this->loadLayout("userHeader.html");
        $this->loadView("userProfile", $data);
        $this->loadLayout("userFooter.html");
        $this->addScript($msg);
    }

    public function logout()
    {
        session_destroy();
        $this->redirect("/login");
    }

    public function lent()
    {
        $user = $this->input->session('id');
        $data["books"] = $this->model->getLentBooks($user);
        $this->loadLayout("userHeader.html");
        $this->loadView("lentBooks", $data);
        $this->loadLayout("userFooter.html");
    }

    public function booked()
    {
        $user = $this->input->session('id');
        $data["books"] = $this->model->getRequestedBooks($user);
        $this->loadLayout("userHeader.html");
        $this->loadView("booked", $data);
        $this->loadLayout("userFooter.html");
    }

    public function search()
    {
        $searchKey = func_get_arg(0);
        $result['result'] = $this->model->getUsersLike($searchKey);
        echo json_encode($result);
    }
}
