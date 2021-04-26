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


Route::add(
    '/books/load/?([0-9]+)?/?([0-9]+)?/?([\d\D]+)?',
    'book/loadBooks',
    'get'
);


Route::add(
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

Route::add('/librarian', 'admin/login');
Route::add('/librarian/login', 'admin/login');

Route::add(
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

Route::add(
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

Route::add(
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


Route::add(
    '/librarian/manageUsers',
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

Route::add(
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


Route::add('/admin/login', 'admin/login');
Route::add('/admin', 'admin/login');
Route::add('/admin/login', 'admin/dologin', 'post');


Route::add(
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

Route::add(
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

