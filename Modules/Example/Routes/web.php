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

use Modules\Example\Http\Controllers\ExampleController;

Route::prefix('search')->group(function() {
    Route::get('/', 'ExampleController@show');
    Route::post('/', 'ExampleController@search');
    Route::post('/save', 'ExampleController@save');
});
