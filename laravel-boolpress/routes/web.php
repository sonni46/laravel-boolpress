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
// rotta che porta alla home principale di laravel 
Route::get('/', 'HomeController@index')->name('home');

// rotta che gestira i posti per l'utente generico 
Route::resource('/posts', 'PostController');
Route::get('/vue-post','PostController@listPostApi')->name('list-post-api');



// serie di rotte che gestisce il meccanismo di autentuicazione
Auth::routes();


// serie di rotte che gesticono i posts admin 
Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')
->group(function(){       //namespace prende la cartella // il prefix prende la cartella e la rinomina                             
   
    Route::get('/', 'HomeController@index')->name('index');
   
    Route::resource('/posts', 'PostController');

   
   
    // Rotta per la pagina profilo 
    Route::get('profile','HomeController@profile')->name('profile');
    Route::post('generate-token','HomeController@generateToken')->name('generate-token');
});



