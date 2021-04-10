<?php

class PdoDbHandler extends DbHandler
{
    public function __construct($host, $user, $pass, $db, $driver)
    {
        $this->con = new PDO("$driver:host=$host;dbname=$db;", $user, $pass);
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM);
    }

    public static function getInstance(string $host, string $user, string $pass, string $db, string $driver)
    {
        if (!self::$instance) {
            self::$instance = new static($host, $user, $pass, $db, $driver);
        }
        return self::$instance;
    }

    public function executeQuery(): bool
    {
        $stmt = $this->con->prepare($this->query);
        $index = 1;
        foreach ((array)$this->bindValues as $bindValue) {
            switch (gettype($bindValue)) {
                case 'integer':
                    $paramType = PDO::PARAM_INT;
                    break;
                default:
                    $paramType = PDO::PARAM_STR;
                    break;
            }
            $stmt->bindValue($index, $bindValue, $paramType);
            $index++;
        }
        $flag = $stmt->execute();
        if ($flag == true) {
            $this->result = $stmt;
        }

        return $flag;
    }

    public function fetch()
    {
        if ($this->result != null) {
            return $this->result->fetch(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }

    public function runQuery(string $sql, array $bindValues=[]): bool
    {
        $stmt = $this->con->prepare($sql);
        $index = 1;
        foreach ($bindValues as $bindValue) {
            switch (gettype($bindValue)) {
                case 'integer':
                    $paramType = PDO::PARAM_INT;
                    break;
                default:
                    $paramType = PDO::PARAM_STR;
                    break;
            }
            $stmt->bindValue($index, $value, $paramType);
            $index++;
        }
        $flag = $stmt->execute();
        if ($flag == true) {
            $this->result = $stmt;
        }
        return $flag;
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
        
        $stmt = $this->con->prepare("SELECT $selectFields FROM $table WHERE $where");
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
        $stmt = $this->con->prepare("INSERT INTO $table($insertFields) VALUES($fieldsValues)");
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

    public function close()
    {
        $this->con = null;
    }

    public function insertId(): int
    {
        return $this->con->lastInsertId();
    }
    public function begin()
    {
        $this->con->beginTransaction();
    }
}
