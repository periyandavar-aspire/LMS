<?php

class LibrarianModel extends BaseModel
{
    public function getProfile(string $email)
    {
        $this->db->select('fullName', 'email', 'updatedAt')->from('admin_user')->where('email', '=', $email)->execute();
        $result = $this->db->fetch();
        return $result;
    }
    
    public function updateProfile(string $email, array $userData)
    {
        $result = $this->db->update('admin_user', $userData)->where('email', '=', $email)->execute();
        return $result;
    }

    public function updatePassword(string $email, string $password)
    {
        $result = $this->db->update('admin_user', ['password' => md5($password)])->where('email', '=', $email)->execute();
        return $result;
    }
}
