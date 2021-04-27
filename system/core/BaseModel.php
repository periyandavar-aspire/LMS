<?php
/**
 * BaseModel
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');
/**
 * Super class for all Model. All Model class should extend this Model.
 * BaseModel class consists of basic level functions for various purposes
 *
 * @category   Model
 * @package    Core
 * @subpackage Model
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class BaseModel
{
    /**
     * Database connection variable
     *
     * @var Database $db
     */
    protected $db;

    /**
     * Instantiate the new BaseModel instance
     */
    public function __construct()
    {
        $this->db = DatabaseFactory::create();
        Log::getInstance()->info("The model is initalized successfully");
    }

    /**
     * Close the db connection
     */
    public function __destruct()
    {
        $this->db->close();
    }
}
