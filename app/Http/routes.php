<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::resource('film', 'FilmController', ['except' => ['index', 'show']]);
    Route::post('/comment/create', 'FilmController@createComment')->name('comment.create');
    
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', function(){
      return redirect('/film');  
    } );
    Route::get('/film', 'FilmController@index');
    Route::get('/film/{id}', 'FilmController@show')->name('film.show');
});
