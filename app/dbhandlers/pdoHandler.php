<?php

class PdoHandler extends DbHandler
{
    public function __construct($driver, $host, $user, $pass, $db)
    {
        $this->db = new PDO("$driver:host=$host;dbname=$db;", $user, $pass) or die("DB error..");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);    
    }

    public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new DbHandler();
		}
		return self::$instance;
	}

    public function executeQuery()
    {
        $stmt = $this->db->prepare($this->query);
        try {
            $flag = $stmt->execute($this->bindValues);
        } catch (Exception $e){
            return false;
        }
        return $flag;
    }

    public function fetch()
    {
        $stmt = $this->db->prepare($this->query);
        try {
            $flag = $stmt->execute($this->bindValues);
            if ($flag) {
                $result = $stmt->fetch(PDO::FETCH_OBJ);
                return $result;
            }
        } catch (Exception $e) {

        }

        return null;
    }

    public function runQuery(string $sql, array $bindValues=[])
    {
        $result = $this->db->query($sql);
        if ($result != false) {
            print_r ($result->fetch(PDO::FETCH_OBJ));
            return $result->fetch(PDO::FETCH_OBJ);
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
        $values = [];
        foreach ($conditions as $key => $value) {
            $where .= $key . " = ? ";
            array_push($values, $value);
        }
        
        $stmt = $this->db->prepare("SELECT $selectFields FROM $table WHERE $where");
        $index = 1;
        foreach ($values as $value) {
            $stmt->bindValue($index++, $value, PDO::PARAM_STR);
        }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function insertQuery(string $table, array $fields, array $values)
    {
        $insertFields = implode(", ", $fields);
        $fieldsValues = '';
        for ($i = 0; $i < count($fields); $i++) {
            $fieldsValues .= ' ?,';
        }
        $fieldsValues = rtrim($fieldsValues, ',');
        $stmt = $this->db->prepare("INSERT INTO $table($insertFields) VALUES($fieldsValues)");
        $index = 1;
        foreach ($values as $value) {
            $stmt->bindValue($index, $value, PDO::PARAM_STR);
            $index++;
        }
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}