<?php
class UserController extends Controller
{
    public function __construct($model = null)
    {
        parent::__construct($model);
    }
    
    public static function home()
    {
        $model = func_get_args()[0] ?? null;
        $obj = static::getMyInstance($model);
        $obj->loadLayout("userHeader.html");
        $obj->loadView("userHome");
        $obj->loadLayout("userFooter.html");
    }

    public static function profile()
    {
        // echo "user profile";
        $obj = static::getMyInstance();
        $obj->loadLayout("userHeader.html");
        $obj->loadView("userProfile");
        $obj->loadLayout("userFooter.html");
    }

    public static function logout()
    {
        $obj = static::getMyInstance();
        $obj->redirect("home/login");
    }

}