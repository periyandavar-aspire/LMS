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
Route::add('/user/home',null ,'get',function () {
    $cname = Utility::staticCtrlFromSession('user');
    if ($cname == null) {
        (new HomeController())->index();
    } else {
        $cname::executeMethod('home');
    }
});