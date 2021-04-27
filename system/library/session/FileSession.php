<?php
/**
 * FileSession Handler
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
 * Custom Session handler
 *
 * @category SessionHandler
 * @package  Library
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class FileSession implements SessionHandlerInterface
{
    private $_savePath;

    /**
     * Session open
     *
     * @param $savePath    Session path
     * @param $sessionName Session name
     *
     * @return bool
     */
    public function open($savePath, $sessionName)
    {
        $this->_savePath = $savePath;
        !is_dir($this->_savePath) and mkdir($this->_savePath, 0777);
        return true;
    }

    /**
     * Session close
     *
     * @return bool
     */
    public function close()
    {
        return true;
    }

    /**
     * Reads data from session
     *
     * @param string $sessId Session Id
     *
     * @return null|string
     */
    public function read($sessId)
    {
        return (string)@file_get_contents("$this->_savePath/$sessId");
    }

    /**
     * Writes data to the session db
     *
     * @param string $sessId Session id
     * @param string $data   Session data
     *
     * @return bool
     */
    public function write($sessId, $data)
    {
        return file_put_contents("$this->_savePath/$sessId", $data) === false
            ? false
            : true;
    }

    /**
     * Destroy sessions
     *
     * @param string $sessId Session Id
     *
     * @return bool
     */
    public function destroy($sessId)
    {
        $file = "$this->_savePath/$sessId";
        file_exists($file) and unlink($file);
        return true;
    }

    /**
     * Session grabage collector
     *
     * @param int $maxlifetime Maximum lifetime
     *
     * @return int|bool
     */
    public function gc($maxlifetime)
    {
        foreach (glob("$this->_savePath/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }
        return true;
    }
}
