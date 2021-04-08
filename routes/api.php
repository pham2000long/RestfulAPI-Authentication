<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
//    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user-profile', 'AuthController@userProfile');
    Route::post('sendPasswordResetLink','PasswordResetRequestController@sendEmail');
    Route::post('resetPassword','ChangePasswordController@passwordResetProcess');
});
Route::post('sendEmail', 'MailController@sendEmail');

// get all user
Route::get('users', 'UserController@index');

// get specific user detail
Route::get('user/{id}', 'UserController@getUserById');

// add User
Route::post('addUser','UserController@createUser');

// update User
Route::put('updateUser/{id}','UserController@updateUser');

// delete
Route::delete('deleteUser/{id}', 'UserController@deleteUser');
