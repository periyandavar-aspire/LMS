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

    public function getValues(string $table, ?array $fields, ?array $conditions)
    {
        if ($fields == null) {
            $selectFields = "*";
        } else {
            $selectFields = implode(", ", $fields);
        }
        $where = '';
        foreach ($conditions as $key => $value) {
            $where .= $key . " = '$value' ";
        }
        $query = "SELECT $selectFields FROM $table WHERE $where";
        // echo $query;
        return $this->executeQuery($query);
    }
}