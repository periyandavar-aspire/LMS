<?php

abstract class Dbhandler
{
    protected $db;
    
    public function close() {
        $this->db = null;
    }

    abstract public function runQuery(string $sql, array $bindValues=[]);
    abstract protected function executeQuery();
    abstract protected function fetch();
    abstract public static function getInstance();
	
    protected static $instance = null;
    protected $query; // $getSQL
    private $sql; // $getSQL incomplete query without where
    protected $bindValues;
	private $table, $columns, $limit, $orderBy ,$where;

    public function query($query, $args = [])
    {
        $this->resetQuery();
        $query = trim($query);
        $this->query = $query;
        $this->bindValues = $args;
        $result = $this->runQuery($this->query, $this->bindValues);
        return $result;
    }

    public function get()
    {
        $this->query  = "SELECT " . $this->columns . " FROM " . $this->table . $this->where . $this->limit . $this->orderBy;
        // echo $this->query. "<br>";
        $result = $this->fetch();
        return $result;
    }

    public function execute()
    {
        $this->query  = $this->sql . $this->where;
        // echo $this->query. "<br>";
        $result = $this->executeQuery();
        return $result;
    }
    
    private function resetQuery()
    {
        $this->table = null;
		$this->columns = null;
		$this->sql = null;
		$this->bindValues = null;
		$this->limit = null;
		$this->orderBy = null;
        $this->where = null;
    }

    public function delete(string $table, ?string $where = null)
    {
        $this->resetQuery();
        $this->sql = "DELETE FROM `$table`";
        if (isset($where)) {
            $this->where = " WHERE $where";
        }
        return $this;
    }

    public function update(string $table, array $fields = [], ?string $where = null)
    {
        $this->resetQuery();
        $set = '';
        $index = 1;
        foreach ($fields as $column => $fied) {
            $set .= "`$column` = ?";
            $this->bindValues[] = $field;
            if ($index < count($fields)) {
                $set .= ", ";
            }
            $index++;
        }
        $this->sql = "UPDATE $table SET " . $set;
        if (isset($where)) {
            $this->where = " WHERE $where";
        }
        return $this;
    }

    public function insert(string $table, array $fields = [])
    {
        $this->resetQuery();
        $keys = implode('`, `', array_keys($fields));
        $values = '';
        $index = 1;
        foreach ($fields as $column => $value) {
            $values .= '?';
            $this->bindValues[] = $value;
            if ($index < count($fields)) {
                $values .= ',';
            }
            $index++;
        }

        $this->sql = "INSERT INTO $table (`$keys`) VALUES ({$values})";
        return $this;
    }

    
	public function select()
	{
        $this->resetQuery();
        $columns = func_get_args();
		for($i = 0; $i < count($columns); $i++) {
			$columns[$i] = trim($columns[$i]);
		}
		$columns = implode('`, `', $columns);
		$this->columns = "`$columns`";
		return $this;
	}

    public function selectAs(array $selectData)
	{
		$fields = array_keys($selectData);
        $as = array_values($selectData);
        $columns = [];
		for($i = 0; $i < count($fields); $i++) {
            $column[] = trim($fields[$i]) . " AS " . trim($as[$i]);
        }
		$columns = implode('`, `', $columns);
		$this->columns = "`$columns`";
		return $this;
	}

    public function selectAll()
	{
        $this->resetQuery();
		$this->columns = "*";
		return $this;
	}

    public function from($tableName)
	{
		$this->table = $tableName;
		return $this;
	}

    // where(str), where(str,bind), where(str,oper,bind)
    public function where()
    {
        if ($this->where == null) {
            $this->where .= " WHERE ";
        } else {
            $this->where .= " AND ";
        }
        $args = func_get_args();
        $count = func_num_args();
        
        if ($count == 1) {
            $arg = $args[0];

            if (is_array($arg)) {
                $index = 1;

                foreach ($arg as $param) {
                    if ($x != 1) {
                        $this->where .= " AND ";
                    }
                    $parmCount = count($param);
                    if ($countParam == 1) {
                        $this->where .= $param;
                    } elseif ($countParam == 2) {
                        $this->where .= $param[0];
                        $this->bindValues[] = $param[1];
                    } elseif ($countParam == 3) {
                        $this->where .= "`" . trim($param[0]) . "`" . $param[1] . " ?";
                        $this->bindValues[] = $param[2];
                    }
                }
            } else {
                $this->where .= $arg;
            }
        } elseif ($count == 2) {
            $this->where .= $args[0];
            $this->bindValues[] = $args[1];
        } elseif ($count == 3) {
            $this->where .= "`" . trim($args[0]) . "`" . $args[1] . " ?";
            $this->bindValues[] = $args[2];
        }
        return $this;
    }

    public function orWhere()
    {
        if ($this->where == null) {
            $this->where .= " WHERE ";
        } else {
            $this->where .= " OR ";
        }
        $args = func_get_args();
        $count = func_num_args();
        
        if ($count == 1) {
            $arg = $args[0];

            if (is_array($arg)) {
                $index = 1;

                foreach ($arg as $param) {
                    if ($x != 1) {
                        $this->where .= " OR ";
                    }
                    $parmCount = count($param);
                    if ($countParam == 1) {
                        $this->where .= $param;
                    } elseif ($countParam == 2) {
                        $this->where .= $param[0];
                        $this->bindValues[] = $param[1];
                    } elseif ($countParam == 3) {
                        $this->where .= "`" . trim($param[0]) . "`" . $param[1] . " ?";
                        $this->bindValues[] = $param[2];
                    }
                }
            } else {
                $this->where .= $arg;
            }
        } elseif ($count == 2) {
            $this->where .= $args[0];
            $this->bindValues[] = $args[1];
        } elseif ($count == 3) {
            $this->where .= "`" . trim($args[0]) . "`" . $args[1] . " ?";
            $this->bindValues[] = $args[2];
        }
        return $this;
    }

    public function limit(int $limit, ?int $offset=null)
	{
		if ($offset ==null ) {
			$this->limit = " LIMIT $limit";
		}else{
			$this->limit = " LIMIT $limit OFFSET $offset";
		}

		return $this;
	}

    public function orderBy($field_name, $order = 'ASC')
	{
		$field_name = trim($field_name);

		$order =  trim(strtoupper($order));

		// validate it's not empty and have a proper valuse
		if ($field_name !== null && ($order == 'ASC' || $order == 'DESC')) {
			if ($this->orderBy ==null ) {
				$this->orderBy = " ORDER BY $field_name $order";
			}else{
				$this->orderBy .= ", $field_name $order";
			}
			
		}

		return $this;
	}

    public function getQuery()
	{
		return $this->query;
	}



}