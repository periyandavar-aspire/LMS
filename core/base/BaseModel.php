<?php
class BaseModel
{
    protected $db;

    public function __construct()
    {
        global $dbConfig;
        if ($dbConfig['usepdo']) {
            $this->db = PdoDbHandler::getInstance($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database'], $dbConfig['driver']);
        } else {
            $handler = $dbConfig['driver'] . "DbHandler";
            $this->db = $handler::getInstance($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['database'], $dbConfig['driver']);
        }
    }
}
