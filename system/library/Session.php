<?php
/**
 * Session
 * php version 7.3.5
 *
 * @category Session
 * @package  Library
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */

defined('VALID_REQ') or exit('Invalid request');
/**
 * Session class set and manage custom session handlers
 *
 * @category Session
 * @package  Library
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class Session
{
    private $_driver;

    private static $_instance;

    /**
     * Instantiate the Session instance
     */
    public function __construct()
    {
        global $config, $dbConfig;
        try {
            session_save_path($config['session_save_path']);
            ini_set("session.gc_maxlifetime", $config['session_expiration']);
            $file = 'system/library/session/'
            . $config['session_driver']
            . 'Session.php';
            $class = $config['session_driver'].'session';
            if (file_exists($file)) {
                include_once "$file";
                $this->_driver = new $class();
            } else {
                throw new FrameworkException("Invalid Driver");
            }
            if (isset($this->_driver)) {
                session_set_save_handler(
                    array($this->_driver, 'open'),
                    array($this->_driver, 'close'),
                    array($this->_driver, 'read'),
                    array($this->_driver, 'write'),
                    array($this->_driver, 'destroy'),
                    array($this->_driver, 'gc')
                );
                register_shutdown_function('session_write_close');
            }
        } catch (Exception $exception) {
            Log::getInstance()->error(
                $exception->getMessage() . " in " . $exception->getFile()
                    ." at line " . $exception->getLine()
            );
            Log::getInstance()->debug(
                "Unable to Register the session driver '$file'"
            );
        }
    }

    /**
     * Returns the instance
     *
     * @return Session
     */
    public static function getInstance(): Session
    {
        self::$_instance = self::$_instance ?? new Session();
        return self::$_instance;
    }
}
