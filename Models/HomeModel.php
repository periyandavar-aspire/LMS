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

    public function getUserPass(string $name)
    {
        return md5("user");
    }
}