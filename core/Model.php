<?php
class Model
{
    protected $db;

    public function __construct()
    {
        global $dbConfig;
        if ($dbConfig['usepdo']) {
            $this->db = Pdohandler::getInstance($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database'], $dbConfig['driver']);
        }
        else {
            $handler = $dbConfig['driver'] . "Handler";
            $this->db = $handler::getInstance($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database'], $dbConfig['driver']);
        }
    }   

    public function __destruct()
    {
        $this->db->close();
    }

}