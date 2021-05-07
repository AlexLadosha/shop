<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/products', [ProductController::class, 'listProducts'])->name('products_list');
Route::get('/product/edit/{id}', [ProductController::class, 'editProduct']);
Route::get('/product/delete/{id}', [ProductController::class, 'deleteProduct']);
Route::post('/product/edit/', [ProductController::class, 'saveExistingProduct']);
Route::get('/product/create', [ProductController::class, 'createProduct']);
Route::post('/product/create', [ProductController::class, 'saveProduct']);

Route::get('/categories', [CategoryController::class, 'listCategories'])->name('categories_list');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory']);
Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCategory']);
Route::post('/category/edit/', [CategoryController::class, 'saveExistingCategory']);
Route::get('/category/create', [CategoryController::class, 'createCategory']);
Route::post('/category/create', [CategoryController::class, 'saveCategory']);
