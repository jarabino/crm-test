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
    if(Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('welcome');
    }
    
});
Route::group(['middleware' => ['web']], function() {

    // Login Routes...
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
        Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    
    // Registration Routes...
        // Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
        // Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);
    
    // Password Reset Routes...
        Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
        Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
        Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
        Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
    });
Route::group(['middleware' => 'auth'], function () {
    Route::resource('employee', EmployeeController::class);
    Route::resource('company', CompanyController::class);
    // Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/language/{locale}', 'LanguageController@changeLocale')->name('locale');
});

