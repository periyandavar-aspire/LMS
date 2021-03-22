<?php
class UserController extends Controller
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
            $data['msg'] = "Invalid $field..!";
        } else if (!$this->model->updateProfile($id, $fields->getValues())) {
            $data['msg'] = "Unable to update the profile..!";
        } else {
            $data['msg'] = "Profile updated successfully..!";
        }
        $password = $this->input->post('password');
        if ($password != '') {
            if (strlen($password) < 6) {
                $data['msg'] .= "Your password is too short..!";
            } else {
                if (!$this->model->updatePassword($id, $password)) {
                    $data['msg'] .= "Unable to update password..!";
                }
            }
        }
        echo $data['msg'];
        // $data['result'] = $this->model->getProfile($id);
        // $this->redirect('user/profile');
        $data['result'] = $this->model->getProfile($id);
        $this->loadLayout("userHeader.html");
        $this->loadView("userProfile", $data);
        $this->loadLayout("userFooter.html");
    }

    public function logout()
    {
        // $obj = static::getMyInstance();
        $this->redirect("home/login");
    }

    public function lent()
    {
        $this->loadLayout("userHeader.html");
        $this->loadView("lentBooks");
        $this->loadLayout("userFooter.html");   
    }

    public function booked()
    {
        $this->loadLayout("userHeader.html");
        $this->loadView("booked");
        $this->loadLayout("userFooter.html");   
    }
}