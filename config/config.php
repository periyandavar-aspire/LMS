<?php
/**
 * Config File all the configurations of the applications are defined here
 * php version 7.3.5
 *
 * @category Config
 * @package  Config
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Not a valid Request');
/**
 * Base URL of the site
 */
$config['base_url'] = "http://lms.com";
/**
 * Path to views Directory
 */
$config['view'] = "app/view/";
/**
 * Path to Models Directory
 */
$config['model'] = "app/model/";
/**
 * Path to Controllers Directory
 */
$config['controller'] ="app/controller/";
/**
 * Path to Layout Directory
 */
$config['layout'] = "static/layout/";
/**
 * Path to custom db handlers
 */
$config['db_handler'] = "app/dbHandler/";
/**
 * Path to services
 */
$config['service'] = "app/service/";
/**
 * Path to static folder
 */
$config['static'] = "";
/**
 * Path to upload folders
 */
$config['upload'] = "";
/**
 * Default page index page
 */
$config['default_page'] = "/home";
/**
 * Set the name of the controller handles errors
 */
$config['error_ctrl'] = "ErrorController";
