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
  return view('welcome');
});

Route::get('/tempreg', 'CustomerRegister@indexTempReg')->name('tempreg');

Route::post('/tempregsend', 'CustomerRegister@addTempCustomer');

Route::get('id/{id}', function ($id) {
  echo 'ID: ' . $id;
});

Route::get('/register/{id}', 'Auth\RegisterController@showRegistrationForm');

Auth::routes();

//Auth::routes(['register' => false]);

//Route::get('/custom/registration/{id}', 'Auth\RegisterController@register')->name('register');

Route::get('/home', 'HomeController@index')->name('home');
