<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'EstateController@index');
Route::get('/about', 'EstateController@about');
Route::get('/blogs', 'EstateController@blogs');
Route::get('/blog/{name?}', 'EstateController@blog')->name('blog');
Route::get('/properties', 'EstateController@properties');
Route::get('/property', 'EstateController@property');
Route::get('/agents', 'EstateController@agents');
Route::get('/agent/{name?}', 'EstateController@agent')->name('agent');
Route::get('/contact', 'EstateController@contact');

Route::group(['middleware'=>'guest'], function(){
    Route::get('/admin', 'AdminController@login')->name('login');
    Route::get('/admin/', 'AdminController@login')->name('login');
    Route::get('/admin/login', 'AdminController@login')->name('login');
    Route::get('/admin/signup', 'AdminController@signup')->name('signup');
    Route::post('/admin/login', 'AdminController@loginPost')->name('login');
    Route::post('/admin/signup', 'AdminController@signupPost')->name('signup');
    Route::get('admin/logout', 'AdminController@logout')->name('logout');
    Route::get('admin/forgot-password', 'AdminController@forgotPassword')->name('forgot-password');
    Route::post('admin/forgot-password', 'AdminController@forgotPassword');
    Route::get('admin/change-password/{name?}', 'AdminController@changePassword')->name('change-password')->where('name','.*');
    Route::post('admin/password', 'AdminController@password')->name('password');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/admin/dashboard','AdminController@index')->name('dashboard');
    Route::post('/admin/logout', 'AdminController@logout')->name('logout');
});

Route::group(['middleware'=>['auth','role:ROLE_ADMIN']],function(){
    Route::get('/admin/setup-profile', 'AdminController@setupProfile')->name('setup-profile');
    Route::post('/admin/setup-profile', 'AdminController@setupProfile')->name('setup-profile');
    Route::get('/admin/reset-password', 'AdminController@resetPassword')->name('reset-password');
    Route::post('/admin/reset-password', 'AdminController@resetPassword');
});

Route::middleware(['auth','role:ROLE_SUPERADMIN'])->group(function(){
    Route::get('/admin/superadmin','SuperadminController@superadmin')->name('superadmin');
});
