<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// authentication
Route::middleware(['auth'])->group(function (){
    // admin
   Route::prefix('admin')->group(function (){
       // users -> admin/users/
       Route::get('/', 'Admin\AdminController@index')->name('admin.index');
       Route::resources([
           'user'=> 'Admin\UserController',
           'role' => 'Admin\RoleController'
       ]);
   }) ;
});