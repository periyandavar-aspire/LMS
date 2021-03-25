<?php

class UserModel extends BaseModel
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function getProfile(string $username)
    {
        $this->db->selectAll()->from('user')->where('username', '=', $username)->execute();
        $result = $this->db->fetch();
        return $result;
    }

    public function updateProfile(string $username, array $userData)
    {
        $result = $this->db->update('user', $userData)->where('username', '=', $username)->execute();
        return $result;
    }

    public function updatePassword(string $username, string $password)
    {
        $result = $this->db->update('user', ['password' => md5($password)])->where('username', '=', $username)->execute();
        return $result;
    }
}
