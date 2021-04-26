<?php
/**
 * Loader File
 * php version 7.3.5
 *
 * @category   Loader
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

defined('VALID_REQ') or exit('Not a valid Request');
/**
 * Loader Class autoloads the files
 *
 * @category   Loader
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class DatabaseSession implements SessionHandlerInterface
{
    private $_db;

    private $_driver;

    private $_table;
    /**
     * Establish Db connection
     *
     * @return void
     */
    public function connect()
    {
        global $dbConfig;
        $handler = $this->_driver . 'Driver';
        $this->_db = $handler::getInstance(
            $dbConfig['host'],
            $dbConfig['user'],
            $dbConfig['password'],
            $dbConfig['database'],
            $dbConfig['driver']
        );
    }

    /**
     * Instantiate the new DatabaseSession instance
     *
     * @param string $driver Database driver
     */
    public function __construct(string $driver)
    {
        $this->_driver = $driver;
    }

    /**
     * Session open
     *
     * @return bool
     */
    public function open($savePath, $sessionName): bool
    {
        $this->connect();
        $this->_table = $savePath;
        return isset($this->_db);
    }

    /**
     * Session close
     *
     * @return bool
     */
    public function close(): bool
    {
        $this->db = null;
        return true;
    }

    /**
     * Reads data from session
     *
     * @param $sess_id Session Id
     *
     * @return null|string
     */
    public function read($sess_id)
    {
        // if (!$this->pdo) {
        //     $this->_db = $this->connect();
        // }
        $this->_db->select("data")->from($this->_table)->where("sess_id", '=', $sess_id);
        $this->_db->execute();
        if ($row = $this->_db->fetch()) {
            return $row->data;
        } else {
            return '';
        }
    }

    /**
     * Writes data to the session db
     *
     * @param $sess_id Session id
     * @param $data    Session data
     *
     * @return bool
     */
    public function write($sess_id, $data)
    {
        $access = time();
        $this->_db->select('id')->from($this->_table)->where('sess_id', '=', $sess_id)->limit(1);
        $this->_db->execute();
        var_export($this->_db->fetch());
        if ($this->_db->fetch()) {
            $this->_db->update($this->_table, ["access" => $access, "data" => $data])
                ->where('sess_id', '=', $sess_id)->limit(1);
            return $this->_db->execute();
        } else {
            $this->_db->insert($this->_table, ["sess_id"=>$sess_id, "access" => $access, "data" => $data]);
            return $this->_db->execute();
        }
    }

    /**
     * Destroy sessions
     *
     * @param $sess_id Session Id
     *
     * @return bool
     */
    public function destroy($sess_id)
    {
        $this->_db->delete($this->_table)->where('sess_id', '=', $sess_id);
        return $this->db->execute();
    }

    /**
     * Session grabage collector
     *
     * @param int $max Maximum lifetime
     *
     * @return int|bool
     */
    public function gc($max)
    {
        $old = time() - $max;
        $this->_db->delete($this->_table)->where('access', '<', $old);
        return $this->db->execute();
    }
}
