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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('clients', 'ClientController')->except(['show']);
    Route::resource('phones', 'PhoneController')->only(['destroy','update']);
    Route::resource('roles', 'RoleController')->only(['store']);
    Route::get('log-activity', 'ControlPanelController@logActivityIndex');
    Route::get('roles', 'ControlPanelController@rolesIndex');
    Route::get('user-settings', 'ControlPanelController@userSettingsIndex');
    Route::put('change-password', 'UserController@changeUserPassword')->name('change.password');
    Route::put('update-user-group', 'ControlPanelController@updateUserGroup')->name('update.usergroup');
    Route::get('/', 'HomeController@index')->name('home');
});
Auth::routes();
