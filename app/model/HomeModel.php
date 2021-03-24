<?php

class HomeModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $result = $this->db->runQuery("SELECT * FROM user");
        $result = $this->db->fetch();
        print_r($result);

        $this->db->selectAll()->from('user')->execute();
        $result = $this->db->fetch();
        print_r($result);
    }

    public function getUserPass(string $mail)
    {
        $this->db->select('mail','password');
        $this->db->from('user');
        $this->db->where('mail', '=', $mail);
        $this->db->execute();
        $result = $this->db->fetch();
        if ($result != null) {
            return $result->password;
        } else {
            return null;
        }
    }

    public function createAccount(array $fields)
    {
        $fields['password'] = md5($fields['password']);
        $flag = $this->db->insert('user', $fields)->execute();
        return  $flag;
    }
}