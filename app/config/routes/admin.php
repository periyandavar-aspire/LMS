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
    '/admin/profile',
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

Route::add(
    '/report',
    'report/getReports',
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

Route::add(
    '/analytics/(book|category|author|user)/?([\d]{4}-[\d]{2}-[\d]{2})?/?([\d]{4}-[\d]{2}-[\d]{2})?',
    'report/getAnalytics',
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

Route::add(
    '/analytics/topList/(book|category|author|user)/([\d]{4}-[\d]{2}-[\d]{2})/([\d]{4}-[\d]{2}-[\d]{2})',
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

Route::add(
    '/admin/profile/update',
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

Route::add(
    '/admin/home',
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

Route::add(
    '/admin',
    'admin/home',
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


Route::add(
    '/get/userDetails/([a-zA-Z0-9_]+)',
    'Issuedbook/getUserDetails',
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

Route::add(
    '/get/bookDetails/([1-9]{1}[0-9]*)',
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

Route::add(
    '/admin/manageUsers',
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

Route::add(
    '/admin/manageUsers',
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

Route::add(
    '/admin/settings',
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

Route::add(
    '/admin/settings',
    '/admin/updateSettings',
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


Route::add(
    '/admin/cms',
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

Route::add(
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

Route::add(
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

Route::add(
    '/categories',
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

Route::add(
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


Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
    '/authors',
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

Route::add(
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


Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
    '/issueBook',
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

Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
    '/userRequest',
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

Route::add(
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

Route::add(
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

Route::add(
    '/books',
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

Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
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

Route::add(
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
Route::add(
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

Route::add(
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

Route::add(
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

Route::add('/book/authors/([A-Za-z ]+)/([0-9 ,]*)', 'author/search');
Route::add('/book/categories/([A-Za-z ]+)/([0-9 ,]*)', 'category/search');

Route::add(
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

Route::add(
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


Route::add('/book/categories', 'category/getCategories');
Route::add('/book/authors', 'author/getAuthors');
Route::add(
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

Route::add(
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
