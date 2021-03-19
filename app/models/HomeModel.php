<?php

class HomeModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $result = $this->db->executeQuery("SELECT * FROM user");
        print_r($result);
    }

    public function getUserPass(string $mail)
    {
        // $query = "SELECT * FROM "
        // $result
        $result = $this->db->getValues('user', ['mail','password'], ['mail' =>$mail]);
        // echo $result->password;
        return $result->password;
        // print_r($result);
    }
}