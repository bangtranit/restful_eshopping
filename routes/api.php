<?php

use Illuminate\Http\Request;
use Laravel\Passport\Http\Controllers\AccessTokenController;

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

/**
* Buyer
*/
// Route::resource('buyers', 'Buyer\BuyerController', ['only'=>['index', 'show']]);
Route::resource('buyers', 'Buyer\BuyerController');

/**
* BuyerTransaction
*/
Route::resource('buyers.transactions', 'Buyer\BuyerTransactionController', ['only' => ['index']]);

/**
* BuyerProduct
*/
Route::resource('buyers.products', 'Buyer\BuyerProductController', ['only' => ['index']]);

/**
* BuyerProduct
*/
Route::resource('buyers.sellers', 'Buyer\BuyerSellerController', ['only' => ['index']]);

/**
* BuyerCategory
*/
Route::resource('buyers.categories', 'Buyer\BuyerCategoryController', ['only' => ['index']]);



/**
* Seller
*/
Route::resource('sellers', 'Seller\SellerController');


/**
* SellerTransactions
*/
Route::resource('sellers.transactions', 'Seller\SellerTransactionController', ['only' => ['index']]);

/**
* SellerCategories
*/
Route::resource('sellers.categories', 'Seller\SellerTransactionController', ['only' => ['index']]);

/**
* SellerBuyers
*/
Route::resource('sellers.buyers', 'Seller\SellerBuyerController', ['only' => ['index']]);

/**
* SellerProducts
*/
Route::resource('sellers.products', 'Seller\SellerProductController', 
	['only' => ['index', 'store', 'update', 'destroy']]);



/**
* Category
*/
Route::resource('categories', 'Category\CategoryController');

/**
* CategoryProduct
*/
Route::resource('categories.products', 'Category\CategoryProductController', ['only' => ['index']]);

/**
* CategorySeller
*/
Route::resource('categories.sellers', 'Category\CategorySellerController', ['only' => ['index']]);

/**
* CategoryTransaction
*/
Route::resource('categories.transactions', 'Category\CategoryTransactionController', ['only' => ['index']]);

/**
* CategoryBuyer
*/
Route::resource('categories.buyers', 'Category\CategoryBuyerController', ['only' => ['index']]);



/**
* Product
*/
Route::resource('products', 'Product\ProductController');

/**
* ProductTransaction
*/
Route::resource('products.transactions', 'Product\ProductTransactionController', 
	['only' => ['index'] ]);

/**
* ProductBuyer
*/
Route::resource('products.buyers', 'Product\ProductBuyerController', 
	['only' => ['index'] ]);

/**
* ProductBuyer
*/
Route::resource('products.categories', 'Product\ProductCategoryController', 
	['only' => ['index', 'update', 'destroy'] ]);

/**
* ProductBuyer
*/
Route::resource('products.buyers.transactions', 'Product\ProductBuyerTransactionController', 
	['only' => ['store'] ]);






/**
* Transaction
*/
Route::resource('transactions', 'Transaction\TransactionController');

/**
* TransactionCategory
*/
Route::resource('transactions.categories', 'Transaction\TransactionCategoryController', ['only' => ['index']]);

/**
* TransactionSeller
*/
Route::resource('transactions.sellers', 'Transaction\TransactionSellerController', ['only' => ['index']]);


/**
* User
*/
Route::resource('users', 'User\UserController');

/**
* UserVerify Email
*/
Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
Route::name('resend')->get('users/{user}/resend', 'User\UserController@resend');


Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

