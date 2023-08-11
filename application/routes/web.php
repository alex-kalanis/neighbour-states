<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

// data from many sources

// lookup through addresses from state-sourced data, now only in czech RUIAN
Route::get('/routing/{country1}/{country2}', '\App\Http\Controllers\LookupController@paths');

Route::get('/', function () {
    return new Response('It runs.');
});
