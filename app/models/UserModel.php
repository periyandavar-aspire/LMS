<?php

class UserModel extends BaseModel
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function getProfile(string $mail)
    {
        $this->db->selectAll()->from('user')->where('mail', '=', $mail)->execute();
        $result = $this->db->fetch();
        return $result;
    }

    public function updateProfile(string $mail, array $userData)
    {
        $result = $this->db->update('user', $userData)->where('mail', '=', $mail)->execute();
        return $result;
    }

    public function updatePassword(string $mail, string $password)
    {
        $result = $this->db->update('user', ['password' => md5($password)])->where('mail', '=', $mail)->execute();
        return $result;
    }
}