<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List all developers
Route::get('developers','DeveloperController@index');

//Show only one devloper
Route::get('developer/{id}','DeveloperController@show');

//Add or Create a new record 
Route::post('developer','DeveloperController@store');

//Update the data of developer
Route::put('developer','DeveloperController@store');

//Delete the record of developer
Route::delete('developer/{id}','DeveloperController@destroy');
