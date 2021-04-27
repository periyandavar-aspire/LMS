<?php
/**
 * DatabaseSession
 * php version 7.3.5
 *
 * @category SessionHandler
 * @package  Library
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */

defined('VALID_REQ') or exit('Invalid request');
/**
 * DatabaseSession class, custom session handler
 *
 * @category SessionHandler
 * @package  Library
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class DatabaseSession implements SessionHandlerInterface
{
    /**
     * Database connection object
     *
     * @var Database
     */
    private $_db;

    /**
     * Session Table Name
     *
     * @var [type]
     */
    private $_table;

    /**
     * Establish Db connection
     *
     * @return void
     */
    public function connect()
    {
        $this->_db = DatabaseFactory::create();
    }

    /**
     * Session open
     *
     * @param $savePath    Session path
     * @param $sessionName Session name
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
     * @param $sessId Session Id
     *
     * @return null|string
     */
    public function read($sessId)
    {
        $this->_db->select("data")
            ->from($this->_table)
            ->where("sessId", '=', $sessId);
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
     * @param $sessId Session id
     * @param $data   Session data
     *
     * @return bool
     */
    public function write($sessId, $data)
    {
        $access = time();
        $this->_db->select('id')
            ->from($this->_table)
            ->where('sessId', '=', $sessId)
            ->limit(1);
        $this->_db->execute();
        if ($this->_db->fetch()) {
            $this->_db->update($this->_table, ["access" => $access, "data" => $data])
                ->where('sessId', '=', $sessId)->limit(1);
            return $this->_db->execute();
        } else {
            $this->_db->insert(
                $this->_table,
                ["sessId"=>$sessId, "access" => $access, "data" => $data]
            );
            return $this->_db->execute();
        }
    }

    /**
     * Destroy sessions
     *
     * @param $sessId Session Id
     *
     * @return bool
     */
    public function destroy($sessId)
    {
        $this->_db->delete($this->_table)->where('sessId', '=', $sessId);
        return $this->_db->execute();
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
