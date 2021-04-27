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
    '/books/load/?([0-9]+)?/?([0-9]+)?/?([\d\D]+)?',
    'book/loadBooks',
    'get'
);


Router::add(
    '/book/view/([1-9]{1}[0-9]*)',
    'book/view',
    'get',
    function () {
        $input = new InputData();
        // if ($input->session('login') == VALID_LOGIN) {
        return true;
        // } else {
        //     Utility::redirectURL('/login');
        // }
    }
);

Router::add('/librarian', 'admin/login');
Router::add('/librarian/login', 'admin/login');

Router::add(
    '/librarian/home',
    'admin/getHomePage',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == LIBR_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/librarian/profile',
    'admin/profile',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == LIBR_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/librarian/profile',
    'admin/updateProfile',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == LIBR_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);


Router::add(
    '/librarian/user-management',
    'manageUser/manageRegUsers',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == LIBR_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/librarian/logout',
    'admin/logout',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == LIBR_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);


Router::add('/admin/login', 'admin/login');
Router::add('/admin', 'admin/login');
Router::add('/admin/login', 'admin/dologin', 'post');


Router::add(
    '/book/search',
    'book/findBook',
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
    '/book/search/?([^/]+)?/?([0-9]+)?/?([0-9]+)?',
    'book/findMoreBooks',
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

