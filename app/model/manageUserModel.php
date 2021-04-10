<?php

class ManageUserModel extends BaseModel
{
    public function getAllUsers(string $email)
    {
        $users = [];
        $this->db->select('id', 'fullName', 'userName', 'email', 'role', 'mobile', 'createdAt', 'status')->from('all_user');
        $this->db->where('email', '!=', $email)->orderBy('id')->execute();
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
        $this->db->execute();
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
    
    public function delete(string $role, int $id)
    {
        $deletionToken = uniqid();
        $field = [ 'deletionToken' => $deletionToken];
        $table = ($role == "User") ? "user" : "admin_user";
        $this->db->update($table, $field)->where('id', '=', $id);
        return $this->db->execute();
    }
}
