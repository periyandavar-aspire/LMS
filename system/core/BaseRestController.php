<?php
/**
 * BaseRestController
 * php version 7.3.5
 *
 * @category Controller
 * @package  Core
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */

namespace System\Core;

defined('VALID_REQ') or exit('Invalid request');
if (!defined('API_REQ')) {
    return;
}
use System\Core\Utility;
use System\Core\Log;

/**
 * Super class for all rest based controller. All rest basef controllers should
 * extend this controller
 * BaseRestController class consists of basic level functions for various purposes
 *
 * @category Controller
 * @package  Core
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class BaseRestController
{
    /**
     * Model class object that will has the link to the Model Class
     * using this variable we can acces the model class functions within this
     * controller Ex : $this->model->getData();
     *
     * @var Model $model
     */
    protected $model;

    /**
     * Input allows us to access the get, post, session, files values
     *
     * @var InputData $input
     */
    protected $input;

    /**
     * Service class object that will offers the services(bussiness logics)
     *
     * @var Service $service
     */
    protected $service;

    /**
     * Log class instance
     *
     * @var Log
     */
    protected $log;

    /**
     * Instantiate the BaseRestController instance
     *
     * @param Model   $model   model class object to intialize $this->model
     * @param Service $service service class object to intialize $this->service
     */
    public function __construct($model = null, $service = null)
    {
        $this->model = $model;
        $this->service = $service;
        $this->input = new InputData();
        $this->log = Log::getInstance();
        $this->log->info(
            "The " . static::class . " class is initalized successfully"
        );
    }

    /**
     * Handles GET requests
     *
     * @return void
     */
    public function get()
    {
    }
    /**
     * Handles POST request
     *
     * @return void
     */
    public function create()
    {
    }
    /**
     * Handles PUT request
     *
     * @return void
     */
    public function update()
    {
    }
    /**
     * Handles DELETE request
     *
     * @return void
     */
    public function delete()
    {
    }
    /**
     * Handles PATCH request
     *
     * @return void
     */
    public function patch()
    {
    }
}
