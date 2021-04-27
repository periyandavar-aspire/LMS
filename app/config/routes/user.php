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
    '/user/home',
    null,
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Router::add(
    '/user/profile',
    null,
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Router::add(
    '/user/profile/update',
    'user/updateProfile',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Router::add(
    '/user/availbleBooks',
    'Book/getAvailableBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Router::add(
    '/user/lentBooks',
    'user/getLentBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Router::add(
    '/user/requestedBooks',
    'user/getRequestedBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);
Router::add(
    '/userRequest/delete/([1-9]{1}[0-9]*)',
    'user/removeRequest',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Router::add(
    '/user/logout',
    null,
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);
Router::add(
    '/book/request/([1-9]{1}[0-9]*)',
    'Issuedbook/request',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);
