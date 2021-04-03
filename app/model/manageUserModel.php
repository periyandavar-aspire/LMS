<?php

class ManageUserModel extends BaseModel
{
    public function getAllUsers(string $email)
    {
        $users = [];
        $this->db->select('id', 'fullName', 'userName', 'email', 'role', 'mobile', 'createdAt')->from('all_user');
        $result = $this->db->where('email', '!=', $email)->orderby('id')->execute();
        while ($row = $this->db->fetch()) {
            $users[] = $row;
        }
        return $users;
    }
    public function getRegUsers()
    {
        $users = [];
        $this->db->select('id', 'fullName', 'userName', 'email', 'mobile', 'createdAt')->from('all_user');
        $result = $this->db->where('role', '=', 'user')->orderby('id')->execute();
        while ($row = $this->db->fetch()) {
            $users[] = $row;
        }
        return $users;
    }
    public function getAllRoles()
    {
        $roles = [];
        $this->db->select('code', 'value')->from('role')->execute();
        while ($row = $this->db->fetch()) {
            $author[] = $row;
        }
        return $author;
    }
    public function addAdminUser(array $user)
    {
        $user['password'] = md5($user['password']);
        $flag = $this->db->insert('admin_user', $user)->execute();
        return  $flag;
    }
}
