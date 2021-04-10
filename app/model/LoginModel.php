<?php
class LoginModel extends BaseModel
{
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function getAdminUser(string $email)
    {
        $this->db->select("password", "role.value type")->from('admin_user')->innerJoin('role')->on('admin_user.role=role.code');
        $this->db->where('email', '=', $email)->where('admin_user.status', '=', 1);
        $this->db->where('admin_user.deletionToken', '=', "N/A")->execute();
        $result = $this->db->fetch();
        return $result;
    }

    // public function getLibrarianPass(string $name)
    // {
    //     return md5("libr");
    // }
}
