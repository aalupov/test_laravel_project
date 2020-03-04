<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

// route to home page
Route::get('/', function () {
    return view('welcome');
});

$groupDataStore = [
    'prefix' => ''
];

// route to user page
Route::group($groupDataStore, function () {
    $methods = [
        'index',
        'edit',
        'update',
        'store',
        'destroy',
        'create'
    ];
    Route::resource('/users', 'UsersController')->only($methods)->names('users');
});

// route to sections page
Route::group($groupDataStore, function () {
    $methods = [
        'index',
        'edit',
        'update',
        'store',
        'destroy',
        'create'
    ];
    Route::resource('/sections', 'SectionsController')->only($methods)->names('sections');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
