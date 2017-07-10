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

Auth::routes();

Route::group(['middleware' => 'auth', 'isActive'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
    Route::resource('user', 'UserController');
});

Route::get('register/confirm/{id}', 'HomeController@confirmEmail');
Route::group(['middleware' => 'guest'], function () {
    Route::get('resend', 'HomeController@getResendActivation')->name('resend');
    Route::post('resend', 'HomeController@postResendActivation');
});


/*
 * for development
 * first : admin
 * second : user
 * */
if (app()->environment() === 'local' && Schema::hasTable('users')) {
    Route::get('/logwith/{id}', function ($id) {
        Auth::loginUsingId($id);
        return redirect()->home();
    });
}

