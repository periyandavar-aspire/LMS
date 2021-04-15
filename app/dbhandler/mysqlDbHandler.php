<?php
/**
 * MysqlDbHandler File Doc Comment
 * php version 7.3.5
 *
 * @category DbHandler
 * @package  DbHandler
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * MysqlDbHandler Class performs database operations with mysqli connection
 *
 * @category   DbHandler
 * @package    DbHandler
 * @subpackage MysqlDbHandler
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class MysqlDbHandler extends BaseDbHandler
{
    /**
     * Instantiate a new MysqlDbHandler instance
     *
     * @param string $host Host
     * @param string $user Username
     * @param string $pass Password
     * @param string $db   Database Name
     */
    public function __construct(string $host, string $user, string $pass, string $db)
    {
        $this->con = new mysqli($host, $user, $pass, $db);
    }

    /**
     * Returns the same instance of the MysqlDbHandler to performs Singleton
     *
     * @param string $host   Host
     * @param string $user   UserName
     * @param string $pass   Password
     * @param string $db     DatabaseName
     * @param string $driver DriverName
     *
     * @return MysqlDbHandler
     */
    public static function getInstance(
        string $host,
        string $user,
        string $pass,
        string $db,
        string $driver
    ): MysqlDbHandler {
        if (!self::$instance) {
            self::$instance = new static($host, $user, $pass, $db);
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

    /**
     * Fetch the records
     *
     * @return object|null
     */
    public function fetch(): ?object
    {
        if ($this->result != null) {
            $obj = $this->result->fetch_object();
            return $obj;
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

    /**
     * Close the Database Connection
     *
     * @return void
     */
    public function close()
    {
        if (is_resource($this->con)
            && get_resource_type($this->con)==='mysql link'
        ) {
            $this->con->close();
        }
        $this->con = null;
    }

    /**
     * Returns the last insert Id
     *
     * @return int
     */
    public function insertId(): int
    {
        return $this->con->insert_id;
    }
}
