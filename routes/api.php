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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
* Buyer
*/
// Route::resource('buyers', 'Buyer\BuyerController', ['only'=>['index', 'show']]);
Route::resource('buyers', 'Buyer\BuyerController');

/**
* Seller
*/
Route::resource('sellers', 'Seller\SellerController');

/**
* Category
*/
Route::resource('categories', 'Category\CategoryController');

/**
* Product
*/
Route::resource('products', 'Product\ProductController');

/**
* Transaction
*/
Route::resource('transactions', 'Transaction\TransactionController');

/**
* User
*/
Route::resource('users', 'User\UserController');

