<?php

abstract class Dbhandler
{
    /**
     * db connection object
     */
    protected $con;
    /**
     * will have the result set of the select query
     */
    protected $result;
    /**
     * abstract function which should implemented in the handler class to close db connection which called by __destruct()
     */
    abstract public function close();
    /**
     * This abstract function should implemented on the handlers to directly run the Query
     */
    abstract public function runQuery(string $sql, array $bindValues=[]): bool;
    /**
     * This abstract function should implemented on the handlers to run the Query called by execute() function
     * It should return true on success and false on failure
     * if the executed query has the result set the set should be stored in the $this->result
     */
    abstract protected function executeQuery(): bool;
    /**
     * This abstract function should implemented on the handlers to fetch the result set called directly from the object
     * It should return a single row result as object on success and null on failure
     */
    abstract public function fetch();
    /**
     * This abstract function should implemented on the handlers to get the instance of the class in 
     * singleton approch
     */
    abstract public static function getInstance(string $host, string $user, string $pass, string $db, string $driver);
	/**
     * Instance of the class
     */
    protected static $instance = null;
    /**
     * @var string $query contains the executed full query after the execute() get executed
     */
    protected $query; // $getSQL
    /**
     * @var string $sql the incomplete query generally without where
     */
    private $sql; // $getSQL incomplete query without where
    /**
     * @var array $bindValues the values to be bind
     */
    protected $bindValues;
    /**
     * @var string $table stores table name if its select query
     */
	private $table;
    /**
     * @var string $columns stores columns
     */
    private $columns;
    /**
     * @var string $limit stores limit value 
     */ 
    private $limit;
    /**
     * @var string $orderBy stores order value
     */ 
    private $orderBy;
    /**
     * @var string $where stores where condition
     */
    private $where;
    /**
     * return executed query in execute function
     */
    public function getSQL()
    {
        return $this->sql;
    }
    /**
     * will close db connection on object destruction
     */
    public function __destruct()
    {
        if ($this->con != null)
            $this->close();
    }
    /**
     * quert function to run directly raw query with or without bind values
     */
    public function query($query, $args = [])
    {
        $this->resetQuery();
        $query = trim($query);
        $this->query = $query;
        $this->bindValues = $args;
        $result = $this->runQuery($this->query, $this->bindValues);
        return $result;
    }

    // public function get()
    // {
    //     // $this->query  = "SELECT " . $this->columns . " FROM " . $this->table . $this->where . $this->limit . $this->orderBy;
    //     // echo $this->query. "<br>";
    //     $result = $this->fetch();
    //     return $result;
    // }
    /**
     * execute function will execute the earlier build query
     * called as execute()
     */
    public function execute()
    {
        if ($this->sql == '') {
            $this->query = "SELECT " . $this->columns . " FROM " . $this->table . $this->where . $this->limit . $this->orderBy;
        } else {
            $this->query  = $this->sql . $this->where;
        }
        $result = $this->executeQuery();
        return $result;
    }
    /**
     * reset all the query build values
     * @access private
     */
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
    /**
     * delete function used to build delete query
     * we can call this in any one of the following ways
     * delete('table', 'id = 1') or delete('table')->where('id = 1');
     */
    public function delete(string $table, ?string $where = null)
    {
        $this->resetQuery();
        $this->sql = "DELETE FROM `$table`";
        if (isset($where)) {
            $this->where = " WHERE $where";
        }
        return $this;
    }
    /**
     * update function used to build update query
     * we can call this in any one of the following ways
     * update('table', 'id = 1') or update('table')->where('id = 1');
     */
    public function update(string $table, array $fields = [], ?string $where = null)
    {
        $this->resetQuery();
        $set = '';
        $index = 1;
        foreach ($fields as $column => $field) {
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
    /**
     * insert function used to build insert query
     * we can call this by the following way
     * insert(table, ['field' => 'value', 'fild1' => 'value1', 'field2' => 'value2'])
     */
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

    /**
     * select function used to build select query
     * we can call this in following way
     * select('field1', 'field2', 'field3');
     */
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
    /**
     * selectAs used to add select fields with as value
     * call this function by 
     * selectAs(['field1' => 'as1', 'field2' => 'as2'])
     */
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
    /**
     * selectAll function used to selectAll fields
     */
    public function selectAll()
	{
        $this->resetQuery();
		$this->columns = "*";
		return $this;
	}
    /**
     * from used to select table in select query
     * use : select('field')->from('table');
     */
    public function from($tableName)
	{
		$this->table = $tableName;
		return $this;
	}
    /**
     * where function to add where condition with AND
     * we can use this in there ways
     * where(str), where(str,bind), where(str,oper,bind)
     * ex:
     * where('id != 1')
     * where('id != ?', 1)
     * where ('id', '!=', 1)
     * $where = ['id != 1']
     * where($where) 
     * $where = ['id != ?', 1]
     * where($where) 
     * $where = ['id', '!=', 1]
     * where($where) 
     */
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
    /**
     * orWhere function to add where condition with OR
     * we can use this in there ways
     * orWhere(str), orWhere(str,bind), orWhere(str,oper,bind)
     * ex:
     * orWhere('id != 1')
     * orWhere('id != ?', 1)
     * orWhere ('id', '!=', 1)
     * $orWhere = ['id != 1']
     * orWhere($orWhere) 
     * $orWhere = ['id != ?', 1]
     * orWhere($orWhere) 
     * $orWhere = ['id', '!=', 1]
     * orWhere($orWhere) 
     */
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
    /**
     * to set limit and offset values in select query
     */
    public function limit(int $limit, ?int $offset=null)
	{
		if ($offset ==null ) {
			$this->limit = " LIMIT $limit";
		}else{
			$this->limit = " LIMIT $limit OFFSET $offset";
		}

		return $this;
	}
    /**
     * to perform sort
     */
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
    /**
     * return query value
     */
    public function getQuery()
	{
		return $this->query;
	}



}