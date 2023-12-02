<?php

use App\Http\Controllers\productData;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// users table
Route::post('/store-user', [UserController::class, 'store']);
Route::get('/get-user', [UserController::class, 'get_user']);
Route::post('update-user/{id}', [UserController::class, 'update']);
Route::post('/delete-user/{id}', [UserController::class, 'delete']);
Route::post('/login', [UserController::class, 'login']);
// Route::post('/upload', [UserController::class, 'uploadimage']);



//Product table 
Route::post('/store-product', [productData::class, 'stored']);
Route::get('/getProduct', [productData::class, 'getproduct']);
Route::post('update-product/{id}', [productData::class, 'updateProduct']);
Route::post('delete-product/{id}', [productData::class, 'delproduct']);


//student
Route::post('/student-inserted', [StudentController::class, 'store_student']);
Route::post('update-student/{id}', [StudentController::class,'update_student']);
Route::post('delete_student/{id}',[StudentController::class,'delete_student']);
Route::get('/get-students',[StudentController::class,'get_student']);
Route::post('login',[StudentController::class,'login_student']);

Route::put('set-sesssion', [StudentController::class,'session_set']);