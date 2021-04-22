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
class EnvParser
{
    /**
     * Env File location
     */
    private $_env;

    /**
     * Instantitate the new EnvParser Instance
     * 
     * @param $file ENV File Name
     */
    public function __construct($file)
    {
        $this->_env = $file;
    }
    
    /**
     * Loads env file values from .env file and add to $_ENV
     *
     * @return void
     */
    public function load()
    {
        $contents = file($this->_env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($contents as $line) {
            if (strpos(trim($line), "#") !== false) {
                continue;
            }
            putenv($line);
        }
    }
}