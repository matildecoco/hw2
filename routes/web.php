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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(["reset" => false]);


Route::post("/usernameCheck", "App\Http\Controllers\Auth\RegisterController@usernameCheck")->name('usernameCheck'); //crea route con metodo post che si 'aggancia' al controller register

 //se l'utente è autenticato, il middleware consentirà alla richiesta di proseguire ulteriormente(sito laravel) 
 Route::group(['middleware' => ['auth']], function () { //se è autenticato si prosegue e si srriva a tutte le routes (sempre agganciate ai relativi controller)
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/searchContent', 'App\Http\Controllers\SearchContentController@index')->name('searchContent');
    Route::post('/searchContent', 'App\Http\Controllers\SearchContentController@do_search_content')->name('do_search_content'); //->name() dà un nome alla route e/o la rinomina
    Route::get('/condividiPost', 'App\Http\Controllers\SearchContentController@condividiPost')->name('condividiPost');
    Route::get('/searchPeople', 'App\Http\Controllers\SearchPeopleController@index')->name('searchPeople'); //i controller dopo @ hanno scritte le funzioni di riferimento
    Route::post('/searchPeople', 'App\Http\Controllers\SearchPeopleController@do_search_people')->name('do_search_people');
    Route::get('/do_search_people_def', 'App\Http\Controllers\SearchPeopleController@do_search_people_def')->name('do_search_people_def');
    Route::get('/follow', 'App\Http\Controllers\SearchPeopleController@follow')->name('follow');
    Route::get('/utenti_seguiti', 'App\Http\Controllers\HomeController@utenti_seguiti')->name('utenti_seguiti');
    Route::get('/stampa_like', 'App\Http\Controllers\HomeController@stampa_like')->name('stampa_like');
    Route::get('/aggiungi_like', 'App\Http\Controllers\HomeController@aggiungi_like')->name('aggiungi_like');
    Route::get('/like_users', 'App\Http\Controllers\HomeController@like_users')->name('like_users');
});  // i controller totali sono 3: home, search content, search people*/