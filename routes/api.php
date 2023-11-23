<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MerchantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//Customers
Route::get("customers" , [CustomerController::class,"index"]);
Route::get("customers/{customer}" , [CustomerController::class,"show"]);

//Merchants
Route::get("merchants" , [MerchantController::class,"index"]);
Route::get("merchants/{merchant}" , [MerchantController::class,"show"]);


//Categories
Route::get("categories" , [CategoryController::class,"index"]);
Route::get("categories/{category}" , [CategoryController::class,"show"]);
