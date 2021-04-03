<?php


Route::add('/', 'home/index');
Route::add('/home', 'home/index');
Route::add('/home/books');
Route::add('/home/aboutus');
Route::add('/login', '/home/login');
Route::add('/register', '/home/registration');
Route::add('/login', '/home/dologin', 'post');
Route::add('/user/signup', '/home/createAccount', 'post');
Route::add('/home/captcha');

Route::add('/home/home');

Route::add('/home/book/view/([1-9]{1}[1-9]*)', 'book/get');

Route::add('/user/home', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/profile', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/profile/update', 'user/updateProfile', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/availbleBooks', 'Book/available', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/lent', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/booked', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/logout', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/login', 'login/admin');

Route::add('/librarian/login', 'login/login');

Route::add('/librarian/home', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/profile', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/profile', 'librarian/updateProfile', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});


Route::add('/librarian/categories', 'category/getAll', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});


Route::add('/librarian/authors', 'author/getAll', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/books', 'book/manageBooks', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/books', 'book/add', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});


Route::add('/librarian/issuedBooks', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/userRequest', 'librarian/manageUserRequest', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/manageUsers', 'manageUser/getRegUsers', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/logout', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});


Route::add('/admin/login', 'login/login');

Route::add('/admin/login', 'login/dologin', 'post');

Route::add('/admin/profile', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/profile/update', 'admin/updateProfile', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/home', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin', 'admin/home', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/categories', 'category/getAll', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

// Route::add('/admin/categories', 'admin/addCategory', 'post', function () {
//     $id = new InputData();
//     if ($id->session('login') == true && $id->session('type') == 'admin') {
//         return true;
//     } else {
//         Utility::redirectURL('admin/login');
//     }
// });

Route::add('/admin/authors', 'author/getAll', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

// Route::add('/admin/authors', 'admin/addAuthor', 'post', function () {
//     $id = new InputData();
//     if ($id->session('login') == true && $id->session('type') == 'admin') {
//         return true;
//     } else {
//         Utility::redirectURL('admin/login');
//     }
// });

Route::add('/admin/books', 'book/manageBooks', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/books', 'book/add', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/issuedBooks', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/manageUsers', 'manageUser/getAllUsers', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/manageUsers', 'manageUser/addUser', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/userRequest', 'admin/manageUserRequest', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/settings', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/settings', '/admin/updateSettings', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});


Route::add('/admin/cms', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/cms', '/admin/updateCms', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/logout', null, 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});



Route::add('/categories/add', 'Category/add', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && ($id->session('type') == 'librarian' ||$id->session('type') == 'admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/authors/add', 'author/add', 'post', function () {
    $id = new InputData();
    if ($id->session('login') == true && ($id->session('type') == 'librarian' || $id->session('type') == 'admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});



Route::add('/book/categories', 'category/getCategories');
Route::add('/book/authors', 'author/getAuthors');
Route::add('/user/allRoles', 'manageUser/getUserRoles', 'get', function () {
    $id = new InputData();
    if ($id->session('login') == true && $id->session('type') == 'admin') {
        return true;
    } else {
        echo "Invalid Request";
    }
});
