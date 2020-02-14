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
    return view('index');
});
Route::view('/quest/thankyou','thankyou')->name('thankyou');
Route::get('/quest/{Question_id}', 'FormController@index')->name('form.index');
Route::post('/quest/ans', 'FormController@store')->name('form.store');
Route::get('/{Question_id}', 'FormController@index')->name('form.GetQuestion');

