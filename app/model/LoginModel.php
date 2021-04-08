<?php
class LoginModel extends BaseModel
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function getAdminUser(string $email)
    {
        $this->db->select("password")->selectAs(["role.value" => 'type'])->from('admin_user')->innerJoin('role')->on('admin_user.role=role.code');
        $this->db->where('email', '=', $email);
        $this->db->where('admin_user.isDeleted', '=', 0)->execute();
        $result = $this->db->fetch();
        return $result;
    }

    // public function getLibrarianPass(string $name)
    // {
    //     return md5("libr");
    // }
}
