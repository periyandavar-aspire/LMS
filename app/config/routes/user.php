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

Router::add(
    '/book-search',
    'book/search',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);


Router::add(
    '/home',
    'user/getHomePage',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('login');
        }
    }
);

Router::add(
    '/user-profile',
    'user/getProfile',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('login');
        }
    }
);

Router::add(
    '/user-profile',
    'user/updateProfile',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('login');
        }
    }
);

Router::add(
    '/available-books',
    'Book/getAvailableBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('login');
        }
    }
);

Router::add(
    '/lent-books',
    'user/getLentBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('login');
        }
    }
);

Router::add(
    '/requested-books',
    'user/getRequestedBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('login');
        }
    }
);
Router::add(
    '/logout',
    'user/logout',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('login');
        }
    }
);

Router::add(
    '/request/([1-9]{1}[0-9]*)',
    'Issuedbook/request',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('login');
        }
    }
);
