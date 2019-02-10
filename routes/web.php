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
Route::get('', function () {
    return redirect()->to('admin/book-list');
});
Route::prefix('admin')->group(function () {
    Route::get('book-list', function () {
        return view('src.admin.book.list');
    });
    Route::get('book-order', function () {
        return view('src.admin.book.order');
    });
});
