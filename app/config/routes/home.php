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
Route::add('/', 'home/getIndexPage');
Route::add('/home', 'home/getIndexPage');
Route::add('/home/books', 'home/getBooks');
Route::add('/home/aboutus', 'home/getAboutus');
Route::add('/login', '/home/login');
Route::add('/signup', '/home/registration');
Route::add('/login', '/home/dologin', 'post');
Route::add('/signup', '/home/createAccount', 'post');
Route::add('/home/captcha', 'home/createCaptcha');


