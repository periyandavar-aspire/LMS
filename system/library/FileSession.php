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
class FileSession implements SessionHandlerInterface
{
    private $_savePath;

    /**
     * Session open
     *
     * @return bool
     */
    public function open($savePath, $sessionName)
    {
        $this->_savePath = $savePath;
        if (!is_dir($this->_savePath)) {
            mkdir($this->_savePath, 0777);
        }

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
     * @param string $sess_id Session Id
     *
     * @return null|string
     */
    public function read($sess_id)
    {
        return (string)@file_get_contents("$this->_savePath/sess_$id");
    }

    /**
     * Writes data to the session db
     *
     * @param string $sess_id Session id
     * @param string $data    Session data
     *
     * @return bool
     */
    public function write($sess_id, $data)
    {
        return file_put_contents("$this->_savePath/$sess_id", $data) === false ? false : true;
    }

    /**
     * Destroy sessions
     *
     * @param string $sess_id Session Id
     *
     * @return bool
     */
    public function destroy($sess_id)
    {
        $file = "$this->_savePath/sess_$id";
        if (file_exists($file)) {
            unlink($file);
        }

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
