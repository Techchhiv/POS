<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function() {
    $category = Category::with('products')->get();
    $user = User::all();
    // $productP = Product::with('customers')->get();
    $customerP = Customer::with('products')->get();
    $customerO = Customer::with('ordersP','product')->get();

    return $customerO;
});

Route::get('/customers', [UserController::class, 'getCustomers']);
Route::post('/customer', [UserController::class, 'createCustomer']);
Route::post('/customer/update/{id}', [UserController::class,'updateCustomer']);
Route::delete('/customer/{id}', [UserController::class,'deleteCustomer']);


Route::get('/customer', [UserController::class, 'getCustomer']);
Route::get('/customers/product', [UserController::class, 'getCustomersProduct']);
Route::get('/customer/products', [UserController::class, 'getCustomerP']);
Route::get('/customer/cart/{id}', [UserController::class, 'getCustomerCart']);

Route::get('/categories', [CategoryController::class, 'getAllCategories']);
Route::get('/category/{name}', [CategoryController::class, 'getCategoryByname']);
Route::post('/category', [CategoryController::class, 'createCategory']);
Route::post('/category/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('/category/{id}', [CategoryController::class, 'deleteCategory']);
Route::get('/categories/product', [CategoryController::class, 'getCategories']);
Route::get('/category/product/{name}', [CategoryController::class, 'getCategory']);

Route::get('/product/{name}', [ProductController::class, 'getProduct']);
Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/product', [ProductController::class, 'createProduct']);
Route::post('/productinfo/{id}', [ProductController::class, 'createProductInfo']);
Route::post('/product/{id}', [ProductController::class, 'updateProduct']);
Route::post('/productinfo/update/{id}', [ProductController::class, 'updateProductInfo']);
Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);
Route::delete('/productinfo/{id}', [ProductController::class, 'deleteProductInfo']);

Route::post('/login', [UserController::class, 'loginUser']);

Route::post('/cart/{id}', [CartController::class,'orderItem']);
Route::get('/cart/checkout/{id}', [CartController::class,'checkout']);
Route::delete('/cart/{id}', [CartController::class,'deleteCart']);

Route::get('/orders', [CartController::class, 'allCustomerOrdered']);
Route::get('/orders/sold', [CartController::class, 'soldOutProduct']);
Route::get('/order/{id}', [CartController::class, 'changeStatusOrder']);
Route::get('/order/delete/{id}', [CartController::class, 'deleteOrderCart']);

