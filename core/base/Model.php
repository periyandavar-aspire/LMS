<?php
class Model
{
    protected $db;

    public function __construct()
    {
        global $dbConfig;
        if ($dbConfig['usepdo']) {
            $this->db = new Pdohandler($dbConfig['driver'], $dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database']);
        }
        else {
            $handler = $dbConfig['driver'] . "Handler";
            $this->db = new $handler($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database']);
        }
    }   

    public function __destruct()
    {
        $this->db->close();
    }

}