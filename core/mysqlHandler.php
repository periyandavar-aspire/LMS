<?php

class MysqlHandler extends DbHandler
{
    public function __construct($host, $user, $pass, $db)
    {
        $this->db = new mysqli($host, $user, $pass, $db) or print "err";
    }

    public function executeQuery(string $sql)
    {
        $result = $this->db->query($sql);
        if ($result != false) {
            return $result->fetch_object();
        } else {
            return null;
        }
    }
}