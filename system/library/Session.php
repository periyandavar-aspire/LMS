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
class Session
{
    private $_driver;

    private static $_instance;
    /**
     * Instantiate the new Session instance
     */
    public function __construct()
    {
        global $config, $dbConfig;
        session_save_path($config['session_save_path']);
        switch ($config['session_driver']) {
            case 'database':
                $this->_driver = new DatabaseSession($dbConfig['driver']);
                break;
            case 'file':
                $this->_driver = new FileSession();
                break;
            default:
                $this->driver = null;
                Log::Debug("Invalid session driver caught and session handler not set");
                break;
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
        }
        register_shutdown_function('session_write_close');
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