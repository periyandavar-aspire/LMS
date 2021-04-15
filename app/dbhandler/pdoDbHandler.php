<?php
/**
 * PdoDbHandler File Doc Comment
 * php version 7.3.5
 *
 * @category DbHandler
 * @package  DbHandler
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * PdoDbHandler Class Handles the data base operations with PDO connection
 *
 * @category   DbHandler
 * @package    DbHandler
 * @subpackage PdoDbHandler
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

class PdoDbHandler extends BaseDbHandler
{
    /**
     * Instantiate a new PdoDbHandler instance
     *
     * @param string $host   Host Name
     * @param string $user   User Name
     * @param string $pass   Password
     * @param string $db     Database Name
     * @param string $driver Driver Name
     */
    public function __construct(string $host, string $user, string $pass, string $db, string $driver)
    {
        $this->con = new PDO("$driver:host=$host;dbname=$db;", $user, $pass);
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM);
    }

    /**
     * Return same PdoDbHandler instance to perform singletone
     *
     * @param string $host   Host Name
     * @param string $user   User Name
     * @param string $pass   Password
     * @param string $db     Database Name
     * @param string $driver Driver Name
     * @return PdoDbHandler
     */
    public static function getInstance(string $host, string $user, string $pass, string $db, string $driver)
    {
        if (!self::$instance) {
            self::$instance = new static($host, $user, $pass, $db, $driver);
        }
        return self::$instance;
    }

    /**
     * Executes the query
     *
     * @return bool
     */
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

    /**
     * Fetch the records
     *
     * @return object|null
     */
    public function fetch(): ?object
    {
        if ($this->result != null) {
            return $this->result->fetch(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }

    /**
     * Directly run the passed query value
     *
     * @param string $sql        Query
     * @param array  $bindValues Values to be bind
     *
     * @return bool
     */
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

    /**
     * Close the Database Connection
     *
     * @return void
     */
    public function close()
    {
        $this->con = null;
    }

    /**
     * Returns the last insert Id
     *
     * @return int
     */
    public function insertId(): int
    {
        return $this->con->lastInsertId();
    }

    /**
     * begin the transaction
     *
     * @return PdoDbHandler
     */
    public function begin(): PdoDbHandler
    {
        $this->con->beginTransaction();
        return $this;
    }
}
