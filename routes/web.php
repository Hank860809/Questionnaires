<?php

use App\Exports\QuestionnaireExport;
use Maatwebsite\Excel\Facades\Excel;

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
Route::view('/quest/thankyou','thankyou')->name('thankyou');
// Route::get('/quest/{Question_id}', 'FormController@index')->name('form.index');
Route::get('{Sr_id}/{Question_id}', 'FormController@index');
Route::post('/quest/ans', 'FormController@store')->name('form.store');

Route::get('/ans/getxlsx' , function(){
    return Excel::download(new QuestionnaireExport,'Ans.xlsx');
});

