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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::resource('tests', 'testController');
Route::resource('testts', 'TesttController');
Route::resource('tets', 'tetController');
Route::resource('skuys', 'SkuyController');
Route::resource('tests', 'testController');
Route::resource('tests', 'testController');
Route::resource('skuys', 'skuyController');
Route::resource('hayus', 'hayuController');
Route::resource('testkeuns', 'TestkeunController');
Route::resource('hajars', 'HajarController');
Route::resource('hajarrs', 'HajarrController');
Route::resource('hajarrrs', 'HajarrrController');
Route::resource('hajarrrrs', 'HajarrrrController');
Route::resource('hajarrrrrs', 'HajarrrrrController');
