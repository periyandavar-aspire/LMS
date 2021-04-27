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
    '/category/loadData',
    'category/load',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);
Router::add(
    '/categories/delete/([1-9]{1}[0-9]*)',
    'Category/delete',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/categories/edit/([1-9]{1}[0-9]*)',
    'Category/get',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/categories/changeStatus/([1-9]{1}[0-9]*)/([0,1]{1})',
    'Category/changeStatus',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/author/loadData',
    'author/load',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);


Router::add(
    '/authors',
    null,
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            $action = $input->post('action');
            $action == null
            ? Utility::redirectURL('authors')
            : Utility::dispatch("/author/$action");
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/authors/edit/([1-9]{1}[0-9]*)',
    'author/get',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/authors/delete/([1-9]{1}[0-9]*)',
    'author/delete',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/authors/changeStatus/([1-9]{1}[0-9]*)/([0,1]{1})',
    'author/changeStatus',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/issueBook/loadData',
    'Issuedbook/loadIssuedBook',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            || $input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/requestBook/loadData',
    'Issuedbook/loadRequestBook',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            || $input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/issueBook',
    'Issuedbook/add',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            || $input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/issuedBook/returned/([1-9]{1}[0-9]*)',
    'Issuedbook/markAsReturn',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            || $input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/userRequest/([1-9]{1}[0-9]*)',
    'Issuedbook/manageRequest',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            || $input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Router::add(
    '/userRequest/([1-9]{1}[0-9]*)',
    'Issuedbook/updateRequest',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            || $input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);
Router::add(
    '/book/loadData',
    'book/load',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/allUser/loadData',
    'manageuser/loadAllUser',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/allregUser/loadData',
    'manageuser/loadRegUser',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/books/add',
    'book/newBook',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/books/add',
    'book/add',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/books/edit/([1-9]{1}[0-9]*)',
    'book/getToEdit',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);
Router::add(
    '/books/edit/([1-9]{1}[0-9]*)',
    'book/update',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/books/delete/([1-9]{1}[0-9]*)',
    'book/delete',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/books/changeStatus/([1-9]{1}[0-9]*)/([0,1]{1})',
    'book/changeStatus',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/user/get/([a-zA-Z0-9_]+)',
    'user/search',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/book/get/([0-9]+)',
    'book/search',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/user/allRoles',
    'manageUser/getUserRoles',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            echo "Invalid Request";
        }
    }
);

Router::add(
    '/user/delete/(user|librarian|admin)/([1-9]{1}[0-9]*)',
    'manageuser/delete',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);


/****
 * REST
 */
Router::add(
    '/categories',
    null,
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && ($input->session('type') == LIBR_USER
            ||$input->session('type') == ADMIN_USER)
        ) {
            $action = $input->post('action');
            $action == null
            ? Utility::redirectURL('categories')
            : Utility::dispatch("/category/$action");
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);