<?php
/**
 * RouteConfig File all the configurations of the routes are defined here
 * php version 7.3.5
 *
 * @category RouteConfig
 * @package  RouteConfig
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */

Route::add('/', 'home/getIndexPage');
Route::add('/home', 'home/getIndexPage');
Route::add('/home/books');
Route::add('/home/aboutus');
Route::add('/login', '/home/login');
Route::add('/register', '/home/registration');
Route::add('/login', '/home/dologin', 'post');
Route::add('/user/signup', '/home/createAccount', 'post');
Route::add('/home/captcha');

Route::add('/home/home');

// Route::add('/home/book/view/([1-9]{1}[0-9]*)', 'book/get');

Route::add(
    '/user/home',
    null,
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add(
    '/user/profile',
    null,
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add(
    '/user/profile/update',
    'user/updateProfile',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add(
    '/user/availbleBooks',
    'Book/getAvailableBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add(
    '/user/lentBooks/?([0-9]+)?/?([0-9]+)?/?([\d\D]+)?',
    'user/getLentBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add(
    '/user/requestedBooks/?([0-9]+)?/?([0-9]+)?/?([\d\D]+)?',
    'user/getRequestedBooks',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add(
    '/books/load/?([0-9]+)?/?([0-9]+)?/?([\d\D]+)?',
    'book/loadBooks',
    'get'
);

Route::add(
    '/userRequest/delete/([1-9]{1}[0-9]*)',
    'user/removeRequest',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add(
    '/user/logout',
    null,
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add(
    '/book/view/([1-9]{1}[0-9]*)',
    'book/view',
    'get',
    function () {
        $input = new InputData();
        // if ($input->session('login') == Constants::VALID_LOGIN) {
            return true;
        // } else {
        //     Utility::redirectURL('/login');
        // }
    }
);

Route::add(
    '/book/request/([1-9]{1}[0-9]*)',
    'Issuedbook/request',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::REG_USER
        ) {
            return true;
        } else {
            Utility::redirectURL('/login');
        }
    }
);

Route::add('/librarian', 'admin/login');
Route::add('/librarian/login', 'admin/login');

Route::add(
    '/librarian/home',
    'admin/home',
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN
            && $input->session('type') == Constants::LIBR_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && $input->session('type') == Constants::LIBR_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && $input->session('type') == Constants::LIBR_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && $input->session('type') == Constants::LIBR_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && $input->session('type') == Constants::LIBR_USER
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
    '/admin/profile',
    null,
    'get',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            || $input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            || $input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            || $input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            || $input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            || $input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            || $input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            || $input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);

Route::add(
    '/book/search',
    'book/findBook',
    'post',
    function () {
        $input = new InputData();
        if ($input->session('login') == Constants::VALID_LOGIN) {
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
        if ($input->session('login') == Constants::VALID_LOGIN) {
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::LIBR_USER
            ||$input->session('type') == Constants::ADMIN_USER)
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
        if ($input->session('login') == Constants::VALID_LOGIN 
            && $input->session('type') == Constants::ADMIN_USER
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
        if ($input->session('login') == Constants::VALID_LOGIN
            && ($input->session('type') == Constants::ADMIN_USER)
        ) {
            return true;
        } else {
            Utility::redirectURL('admin/login');
        }
    }
);
