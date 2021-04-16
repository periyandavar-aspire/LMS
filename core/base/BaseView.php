<?php
/**
 * BaseView File Doc Comment
 * php version 7.3.5
 *
 * @category View
 * @package  View
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') OR exit('Not a valid Request');
/**
 * BaseView Class Base class for all View Classes
 *
 * @category   View
 * @package    View
 * @subpackage BaseView
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class BaseView
{
    protected $file;
    protected $data = [];

    /**
     * Instantiate the new View instance
     *
     * @param string $file Template file name
     */
    public function __construct(?string $file = null)
    {
        $this->file = $file;
    }

    /**
     * Sets the template file
     *
     * @param string $file File Name
     * 
     * @return void
     */
    public function setFile(string $file)
    {
        $this->file = $file;
    }

    /**
     * Sets the values
     *
     * @param string $key   key name
     * @param string $value value
     * 
     * @return void
     */
    public function set(string $key, string $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Appends values to the data array
     * 
     * @param array $data values
     *
     * @return void
     */
    public function appendData(array $data)
    {
        $this->data = array_merge($this->data, $data);
    }


    /**
     * Displays the contents
     *
     * @return void
     */
    public function output()
    {
        global $config;
        $file = $config['template'] . "/" . $this->file;
        if (!file_exists($file)) {
            throw new Exception("Template " . $this->file . " doesn't exist.");
        }
        extract($this->data);
        ob_start();
        include $file;
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
}
