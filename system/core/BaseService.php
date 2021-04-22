<?php
/**
 * BaseService File Doc Comment
 * php version 7.3.5
 *
 * @category Service
 * @package  Service
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Not a valid Request');
/**
 * BaseService Class Base class for all services
 *
 * @category   Service
 * @package    Service
 * @subpackage BaseService
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class BaseService
{
    /**
     * Converts the array into object
     *
     * @param array $data data
     * 
     * @return object
     */
    public function toObject(array $data): object
    {
        $obj = new stdClass();
        foreach ($data as $key => $value) {
            $obj->$key = $value;
        }
        return $obj;
    }

    /**
     * Converts the array into array of object
     *
     * @param array $data data
     * 
     * @return array
     */
    public function toArrayObjects(array $data): array
    {
        $result = [];
        foreach ($data as $record) {
            $obj = new stdClass();
            foreach ($array as $key => $value) {
                $obj->$key = $value;
            }
            $result[] = $obj;   
        }
        return $result;
    }
}
