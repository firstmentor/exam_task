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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('add-category','CategoryController@addCategory'); 
Route::get('edit-category/{id}','CategoryController@editCategory'); 
Route::post('submit-category','CategoryController@store'); 
Route::get('/view-category', 'CategoryController@categoryView'); 
Route::get('/view-category-list', 'CategoryController@categoryViewList'); 
Route::get('delete-category/{id}','CategoryController@destroy'); 

Route::get('add-exam','ExamController@addExam'); 
Route::post('submit-exam-question','ExamController@examStore'); 
Route::get('edit-exam/{id}','ExamController@editExam'); 
Route::get('/view-exam', 'ExamController@examView'); 
Route::get('/view-exam-list', 'ExamController@examViewList'); 
Route::get('delete-exam/{id}','ExamController@destroy'); 


Route::get('/','MainController@allExam'); 
Route::post('all-exam-question','MainController@allExamQuestion'); 
