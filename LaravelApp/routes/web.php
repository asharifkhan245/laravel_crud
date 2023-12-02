<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\productData;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Product;

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

// Route::get('/', function  () {
//     return view('welcome');
// });


Route::get('/first', [UserController::class, 'users']);

Route::get('/first', [productData::class, 'gets_product']);

Route::post('delete/{id}', [productData::class, 'remove_product']);

Route::post('/edit/{id}', [productData::class, 'edit_product']);

Route::post('/add', [productData::class, 'add']);
