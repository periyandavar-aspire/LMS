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

Route::add('/home/book/view/([1-9]{1}[0-9]*)', 'book/get');

Route::add('/user/home', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/profile', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/profile/update', 'user/updateProfile', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/availbleBooks', 'Book/available', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/lent', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/booked', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/user/logout', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'user') {
        return true;
    } else {
        Utility::redirectURL('login');
    }
});

Route::add('/librarian/login', 'login/login');

Route::add('/librarian/home', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/profile', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/profile', 'librarian/updateProfile', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});


Route::add('/librarian/categories', 'category/getAll', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});


Route::add('/librarian/authors', 'author/getAll', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/books', 'book/manageBooks', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/books', 'book/add', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});


Route::add('/librarian/issuedBooks', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/userRequest', 'librarian/manageUserRequest', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/manageUsers', 'manageUser/getRegUsers', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/librarian/logout', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Librarian') {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});


Route::add('/admin/login', 'login/login');

Route::add('/admin/login', 'login/dologin', 'post');

Route::add('/admin/profile', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/profile/update', 'admin/updateProfile', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/home', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin', 'admin/home', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});


// Route::add('/admin/categories', 'admin/addCategory', 'post', function () {
//     $input = new InputData();
//     if ($input->session('login') == true && $input->session('type') == 'Admin') {
//         return true;
//     } else {
//         Utility::redirectURL('admin/login');
//     }
// });



// Route::add('/admin/authors', 'admin/addAuthor', 'post', function () {
//     $input = new InputData();
//     if ($input->session('login') == true && $input->session('type') == 'Admin') {
//         return true;
//     } else {
//         Utility::redirectURL('admin/login');
//     }
// });



// Route::add('/admin/issuedBooks', null, 'get', function () {
//     $input = new InputData();
//     if ($input->session('login') == true && $input->session('type') == 'Admin') {
//         return true;
//     } else {
//         Utility::redirectURL('admin/login');
//     }
// });

Route::add('/admin/userDetails/([a-zA-Z0-9_]+)', 'issuedBooks/getUserDetails', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/bookDetails/([1-9]{1}[0-9]*)', 'issuedBooks/getBookDetails', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});


Route::add('/admin/issuedBooks', 'issuedBooks/issue', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/issueBook', 'issuedBooks/add', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});


Route::add('/admin/manageUsers', 'manageUser/getAllUsers', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/manageUsers', 'manageUser/addUser', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/userRequest', 'admin/manageUserRequest', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/settings', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/settings', '/admin/updateSettings', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});


Route::add('/admin/cms', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/cms', '/admin/updateCms', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/admin/logout', null, 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/categories', 'category/getAll', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});


Route::add('/categories', null, 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        $action = $input->post('action');
        $action == null ? Utility::redirectURL('categories') : Utility::dispatch("/category/$action") ;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

// Route::add('/categories', 'Category/update', 'post', function () {
//     $input = new InputData();
//     if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
//         return true;
//     } else {
//         Utility::redirectURL('librarian/login');
//     }
// });

Route::add('/categories/delete/([1-9]{1}[0-9]*)', 'Category/delete', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/categories/edit/([1-9]{1}[0-9]*)', 'Category/get', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/categories/changeStatus/([1-9]{1}[0-9]*)/([0,1]{1})', 'Category/changeStatus', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/authors', 'author/getAll', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/authors', null, 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        $action = $input->post('action');
        $action == null ? Utility::redirectURL('authors') : Utility::dispatch("/author/$action") ;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/authors/edit/([1-9]{1}[0-9]*)', 'author/get', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/authors/delete/([1-9]{1}[0-9]*)', 'author/delete', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/authors/changeStatus/([1-9]{1}[0-9]*)/([0,1]{1})', 'author/changeStatus', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

// Route::add('/authors/add', 'author/add', 'post', function () {
//     $input = new InputData();
//     if ($input->session('login') == true && ($input->session('type') == 'Librarian' || $input->session('type') == 'Admin')) {
//         return true;
//     } else {
//         Utility::redirectURL('librarian/login');
//     }
// });

Route::add('/books', 'book/manageBooks', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' || $input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/books/add', 'book/newBook', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/books/add', 'book/add', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        Utility::redirectURL('admin/login');
    }
});

Route::add('/books/edit/([1-9]{1}[0-9]*)', 'book/edit', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/books/edit/([1-9]{1}[0-9]*)', 'book/update', 'post', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/books/delete/([1-9]{1}[0-9]*)', 'book/delete', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/books/changeStatus/([1-9]{1}[0-9]*)/([0,1]{1})', 'book/changeStatus', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Librarian' ||$input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});

Route::add('/book/authors/([A-Za-z ]+)/([0-9 ,]*)', 'author/searchAuthor');

Route::add('/book/categories/([A-Za-z ]+)/([0-9 ,]*)', 'category/searchCategory');

Route::add('/book/categories', 'category/getCategories');
Route::add('/book/authors', 'author/getAuthors');
Route::add('/user/allRoles', 'manageUser/getUserRoles', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && $input->session('type') == 'Admin') {
        return true;
    } else {
        echo "Invalid Request";
    }
});

Route::add('/user/delete/(user|librarian)/([1-9]{1}[0-9]*)', 'manageuser/delete', 'get', function () {
    $input = new InputData();
    if ($input->session('login') == true && ($input->session('type') == 'Admin')) {
        return true;
    } else {
        Utility::redirectURL('librarian/login');
    }
});
