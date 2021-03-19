<?php

class PdoHandler extends DbHandler
{
    public function __construct($driver, $host, $user, $pass, $db)
    {
        $this->db = new PDO("$driver:host=$host;dbname=$db;", $user, $pass) or die("DB error..");
    }

    public function executeQuery(string $sql)
    {
        $result = $this->db->query($sql);
        if ($result != false) {
            print_r ($result->fetch(PDO::FETCH_OBJ));
            return $result->fetch(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }
}