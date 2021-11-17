<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('contact', 'HomeController@hendleContactForm')->name('contact.send');
Route::get('/thank-you', 'HomeController@thankYou')->name('contact.thank-you');

Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')
->group(function(){
    //pagina di atterraggio dopo il login (con il prefix, l'url è /admin)
    Route::get('/', 'HomeController@index')->name('index');
   
    Route::resource('/posts', 'PostController');
});

Route::resource('/posts', 'PostController');
