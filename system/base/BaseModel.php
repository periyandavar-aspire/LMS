<?php
/**
 * BaseModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') OR exit('Not a valid Request');
/**
 * Super class for all Model. All Model class should extend this Model.
 * BaseModel class consists of basic level functions for various purposes
 *
 * @category   Model
 * @package    Model
 * @subpackage BaseModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class BaseModel
{
    /**
     * Database connection variable
     *
     * @var BaseDbHandler $db
     */
    protected $db;

    /**
     * Instantiate the new BaseModel instance
     */
    public function __construct()
    {
        global $dbConfig;
        $handler = $dbConfig['driver'] . 'Driver';
        $this->db = $handler::getInstance(
            $dbConfig['host'],
            $dbConfig['user'],
            $dbConfig['password'],
            $dbConfig['database'],
            $dbConfig['driver']
        );
    }
    /**
     * Close the db connection
     */
    public function __destruct()
    {
        $this->db->close();
    }
}
