<?php

use Illuminate\Support\Facades\Route;
use App\Services\CalculatorService;

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
Route::post('/blogs/{blog}/comments', 'EstateController@comments')->name('comments');
Route::post('/comments/{comment}/reply', 'EstateController@reply')->name('reply');
Route::get('/properties', 'EstateController@properties');
Route::post('/properties', 'EstateController@properties')->name('properties');
Route::get('/property/{id}', 'EstateController@property')->name('property')->where('id','.*');
Route::get('/agents', 'EstateController@agents');
Route::get('/agent/{name?}', 'EstateController@agent')->name('agent');
Route::get('/contact', 'EstateController@contact')->name('contact');
Route::post('/contact', 'EstateController@contact');
Route::get('/testimony', 'EstateController@testimony')->name('testimony');
Route::post('/testimony', 'EstateController@testimony');
Route::post('/contact_agent', 'EstateController@contact_agent');
 Route::post('/comments', 'EstateController@comments')->name('comments');


Route::group(['middleware'=>'guest'], function(){
    Route::get('/login', 'AdminController@login')->name('login');
    Route::post('/login', 'AdminController@loginPost');
    Route::get('/signup', 'AdminController@signup')->name('signup');
    Route::post('/signup', 'AdminController@signup');
    Route::get('/logout', 'AdminController@logout')->name('logout');
    Route::get('/forgot-password', 'AdminController@forgotPassword')->name('forgot-password');
    Route::post('/forgot-password', 'AdminController@forgotPassword');
    Route::get('/change-password/{name?}', 'AdminController@changePassword')->name('change-password')->where('name','.*');
    Route::post('/password', 'AdminController@password')->name('password');
});


Route::group(['middleware'=>['auth','preventBackHistory']],function(){

    Route::get('/dashboard','AdminController@index')->name('dashboard');
    Route::post('/logout', 'AdminController@logout');
    Route::get('/setup-profile', 'AdminController@setupProfile')->name('setup-profile');
    Route::post('/setup-profile', 'AdminController@setupProfile');
    Route::get('/reset-password', 'AdminController@resetPassword')->name('reset-password');
    Route::post('/reset-password', 'AdminController@resetPassword');
    Route::get('/add-property', 'AdminController@addProperty')->name('add-property');
    Route::post('/add-property', 'AdminController@addProperty');
    Route::get('/edit-property/{id}', 'AdminController@editProperty')->name('edit-property')->where('id','.*');
    Route::put('/update-property', 'AdminController@updateProperty');
    Route::get('/list-properties', 'AdminController@listProperties')->name('list-properties');
    Route::delete('/delete-property/{id}', 'AdminController@deleteProperty')->name('delete-property');

    Route::group(['middleware'=>['role:ROLE_ADMIN']],function(){
        Route::get('/post', 'AdminController@blogPost')->name('post');
        Route::post('/post', 'AdminController@blogPost');
        Route::get('/posts', 'AdminController@posts')->name('posts');
        Route::get('/settings', 'AdminController@settings')->name('settings');
        Route::post('/grant_access', 'AdminController@grant_access')->name('grant_access');
        Route::get('/edit-blog-post/{id}', 'AdminController@editBlogPost')->name('edit-blog-post')->where('id','.*');
        Route::put('/update-blog-post', 'AdminController@updateBlogPost');
        Route::delete('/delete-blog-post/{id}', 'AdminController@deleteBlogPost')->name('delete-blog-post');
 
    });

    Route::group(['middleware'=>['role:ROLE_AGENT']],function(){
    
    });


});






