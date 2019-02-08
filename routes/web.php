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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('book')->group(function () {
    Route::get('borrow/{book}', 'BookController@book_borrow')->name('book.borrow');
    Route::get('borrowed', 'BookController@book_borrowed')->name('book.borrowed');
    Route::post('borrow/{book}', 'BookController@book_borrowing')->name('book.borrowing');
    Route::get('return/{book}', 'BookController@book_return')->name('book.return');
    Route::post('return/{book}', 'BookController@book_doreturn')->name('book.doreturn');
});
Route::prefix('report')->group(function () {
    Route::get('/', 'ReportController@index')->name('report.all');
    Route::get('/borrow', 'ReportController@borrow')->name('report.borrow');
});
