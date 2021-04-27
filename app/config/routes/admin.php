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
    '/admin/profile',
    'admin/getProfile',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/librarian/profile',
    'admin/getProfile',
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
    '/report',
    'report/get',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/analytics/(book|category|author|user)/'
        . '?([\d]{4}-[\d]{2}-[\d]{2})?/?([\d]{4}-[\d]{2}-[\d]{2})?',
    'report/analytics',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/analytics/topList/(book|category|author|user)/'
        . '([\d]{4}-[\d]{2}-[\d]{2})/([\d]{4}-[\d]{2}-[\d]{2})',
    'report/topList',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/admin/profile',
    'admin/updateProfile',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/admin/home',
    '/admin/getHomePage',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);


// Router::add(
//     '/user/([a-zA-Z0-9_]+)',
//     'Issuedbook/getUserDetails',
//     'get',
//     function () {
//         $input = new InputData();
//         if ($input->session('login') == VALID_LOGIN
//             && ($input->session('type') == LIBR_USER
//             ||$input->session('type') == ADMIN_USER)
//         ) {
//             return true;
//         } else {
//             Utility::redirectURL('admin/login');
//         }
//     }
// );

Router::add(
    '/book/([1-9]{1}[0-9]*)',
    'Issuedbook/getBookDetails',
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
    '/admin/user-management',
    'manageUser/manageAllUsers',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/admin/users',
    'manageUser/addUser',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/admin/settings',
    'admin/getSettings',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/admin/settings',
    'admin/updateSettings',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);


Router::add(
    '/admin/cms',
    'admin/getCms',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/admin/cms',
    '/admin/updateCms',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Router::add(
    '/admin/logout',
    null,
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == VALID_LOGIN
            && $input->session('type') == ADMIN_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);


Router::add(
    '/book/export/csv',
    'report/exportToCsv',
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
    '/book/export/pdf',
    'report/exportToPdf',
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
    '/category-management',
    'category/manage',
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
    '/author-management',
    'author/manage',
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
    '/issuebook-management',
    'Issuedbook/issue',
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
    '/request-management',
    'Issuedbook/manageUserRequest',
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
    '/book-management',
    'book/manageBooks',
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


Router::add('/book/authors/([A-Za-z ]+)/([0-9 ,]*)', 'author/search');
Router::add('/book/categories/([A-Za-z ]+)/([0-9 ,]*)', 'category/search');


Router::add('/book/categories', 'category/getCategories');
Router::add('/book/authors', 'author/getAuthors');

