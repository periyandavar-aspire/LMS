<?php
/**
 * Routes File all the configurations of the routes are defined here
 * php version 7.3.5
 *
 * @category   Route
 * @package    Routes
 * @subpackage Routes
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');

Router::add('/', 'home/getIndexPage');
Router::add('/books', 'home/getBooks');
Router::add('/aboutus', 'home/getAboutus');
Router::add('/login', '/home/login', 'get', null, 'loginPage');
Router::add('/signup', '/home/registration', 'get', null, 'registrationPage');
Router::add('/login', '/home/dologin', 'post');
Router::add('/signup', '/home/createAccount', 'post');
Router::add('/captcha', 'home/createCaptcha');
Router::add(
    '/user-management/users/email/([\s\S]*)',
    'user/isEmailAvailable'
);
Router::add(
    '/user-management/users/user-name/([a-zA-Z0-9_]+)',
    'user/isNameAvailable'
);
