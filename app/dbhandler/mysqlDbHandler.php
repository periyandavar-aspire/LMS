<?php

class MysqlDbHandler extends DbHandler
{
    public function __construct(string $host, string $user, string $pass, string $db)
    {
        $this->con = new mysqli($host, $user, $pass, $db) or print "err";
    }

    public static function getInstance(string $host, string $user, string $pass, string $db, string $driver)
    {
        if (!self::$instance) {
            self::$instance = new static($host, $user, $pass, $db);
        }
        return self::$instance;
    }

    public function executeQuery(): bool
    {
        $stmt = $this->con->prepare($this->query);
        $paramType = "";
        if (is_array($this->bindValues)) {
            foreach ($this->bindValues as $bindValue) {
                switch (gettype($bindValue)) {
                    case 'integer':
                        $paramType .= "i";
                        break;
                    case 'double':
                        $paramType .= "d";
                        break;
                    default:
                        $paramType .= "s";
                        break;
                }
            }
            $stmt->bind_param($paramType, ...$this->bindValues);
        }
        $flag = $stmt->execute();
        if ($flag == true) {
            $result = $stmt->get_result();
            if ($result == false) {
                $this->result = null;
            } else {
                $this->result = $result;
            }
        }
        return $flag;
    }

    public function fetch()
    {
        if ($this->result != null) {
            $obj = $this->result->fetch_object();
            return $obj;
        } else {
            return null;
        }
    }

    public function runQuery(string $sql, array $bindValues=[]): bool
    {
        $stmt = $this->con->prepare($sql);
        $paramType = "";
        foreach ($bindValues as $bindValue) {
            switch (gettype($bindValue)) {
                case 'integer':
                    $paramType .= "i";
                    break;
                case 'double':
                    $paramType .= "d";
                    break;
                default:
                    $paramType .= "s";
                    break;
            }
        }
        $stmt->bind_param($paramType, ...$bindValues);
        $flag = $stmt->execute();
        if ($flag == true) {
            $result = $stmt->get_result();
            if ($result == false) {
                $this->result = null;
            } else {
                $this->result = $result;
            }
        }
        return $flag;
    }

    // public function getValues(string $table, ?array $fields, ?array $conditions)
    // {
    //     if ($fields == null) {
    //         $selectFields = "*";
    //     } else {
    //         $selectFields = implode(", ", $fields);
    //     }
    //     $where = '';
    //     foreach ($conditions as $key => $value) {
    //         $where .= $key . " = '$value' ";
    //     }
    //     $query = "SELECT $selectFields FROM $table WHERE $where";
    //     // echo $query;
    //     return $this->executeQuery($query);
    // }

    public function close()
    {
        if (is_resource($this->con) && get_resource_type($this->con)==='mysql link') {
            $this->con->close();
        }
        $this->con = null;
    }
}
