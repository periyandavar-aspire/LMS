<?php

class ManageUserModel extends BaseModel
{
    public function getAllUsers(string $email)
    {
        $users = [];
        $this->db->select('id', 'fullName', 'userName', 'email', 'role', 'mobile', 'createdAt')->from('all_user');
        $result = $this->db->where('email', '!=', $email)->orderby('id');
        $this->db->where('isDeleted', '=', 0)->execute();
        while ($row = $this->db->fetch()) {
            $users[] = $row;
        }
        return $users;
    }
    public function getRegUsers()
    {
        $users = [];
        $this->db->select('id', 'fullName', 'userName', 'email', 'mobile', 'createdAt')->from('all_user');
        $result = $this->db->where('role', '=', 'user')->orderby('id');
        $this->db->where('isDeleted', '=', 0)->execute();
        while ($row = $this->db->fetch()) {
            $users[] = $row;
        }
        return $users;
    }
    public function getAllRoles()
    {
        $roles = [];
        $this->db->select('code', 'value')->from('role');
        $this->db->where('isDeleted', '=', 0)->execute();
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
    
    public function delete(string $role, int $id)
    {
        $table = ($role == "user") ? "user" : "admin_user";
        $this->db->delete($table)->where('id', '=', $id);
        return $this->db->execute();
    }
}
