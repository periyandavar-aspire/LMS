<?php


Route::add('/', 'home/index');
Route::add('/home', 'home/index');
Route::add('/home/books');
Route::add('/home/aboutus');
Route::add('/login', '/home/login');
Route::add('/register', '/home/registration');
Route::add('/login', '/home/dologin', 'post');
Route::add('/register', '/home/registration', 'post');
Route::add('/home/captcha');

Route::add('/home/home');

Route::add('/user/home', null ,'get', function () {
        $id = new InputData();
        if ($id->session('login') == true && $id->session('type') == 'user') {
                return true;
        } else {
                (new HomeController())->index();   
        }
});

Route::add('/user/profile', null, 'get', function () {
        $id = new InputData();
        if ($id->session('login') == true && $id->session('type') == 'user') {
                return true;
        } else {
                (new HomeController())->index();   
        }
});

Route::add('/user/profile/update', 'user/updateProfile', 'post', function () {
        $id = new InputData();
        if ($id->session('login') == true && $id->session('type') == 'user') {
                return true;
        } else {
                (new HomeController())->index();   
        }
});

Route::add('/user/availbleBooks', 'Books/available', 'get', function () {
        $id = new InputData();
        if ($id->session('login') == true && $id->session('type') == 'user') {
                return true;
        } else {
                (new HomeController())->index();   
        }
});

Route::add('/user/lent', null, 'get', function () {
        $id = new InputData();
        if ($id->session('login') == true && $id->session('type') == 'user') {
                return true;
        } else {
                (new HomeController())->index();   
        }
});

Route::add('/user/booked', null, 'get', function () {
        $id = new InputData();
        if ($id->session('login') == true && $id->session('type') == 'user') {
                return true;
        } else {
                (new HomeController())->index();   
        }
});

Route::add('/user/logout', null, 'get', function () {
        $id = new InputData();
        if ($id->session('login') == true && $id->session('type') == 'user') {
                return true;
        } else {
                (new HomeController())->index();   
        }
});
