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
        $this->db->where('email', '=', $email)->execute();
        $result = $this->db->fetch();
        return $result;
        // return $this->db->fetch();
    }

    // public function getLibrarianPass(string $name)
    // {
    //     return md5("libr");
    // }
}
