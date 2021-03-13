<?php
class LoginModel extends Model
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function getAdminPass(string $user)
    {
        // echo "admin<br>";
        return md5("admin");
    }

    public function getLibrarianPass(string $name)
    {
        return md5("libr");
    }

    public function getUserPass(string $name)
    {
        return md5("user");
    }

}