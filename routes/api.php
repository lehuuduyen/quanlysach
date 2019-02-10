<?php

use Illuminate\Http\Request;

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

//Route::get('/book', function (Request $request) {
//    return 1;
//});
Route::prefix('book')->group(function () {
    Route::get('show/{id}','BookController@show');
    Route::get('list','BookController@index');
    Route::post('store','BookController@store');
    Route::post('vote','BookController@vote');
});
