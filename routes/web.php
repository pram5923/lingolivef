<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

//Route::get('/', function () {
////return view('welcome');
//});

Route::get('/product', [ProductController::class, 'list'])->name('product.list');
Route::get('/admin/product',[ProductController::class, 'admin'])->name('admin.product');
Route::get('/admin/product/create',[ProductController::class, 'createForm'])->name('admin.create-product-form');
Route::post('/admin/product/create',[ProductController::class, 'create'])->name('admin.create-product');
Route::get('/admin/product/{product}/update',[ProductController::class, 'updateForm'])->name('admin.update-form');
Route::post('/admin/product/{product}/update',[ProductController::class, 'update'])->name('admin.update');
Route::get('/admin/product/{product}/delete',[ProductController::class, 'delete'])->name('admin.delete');


Route::get('/shop', [ShopController::class, 'list'])->name('shop-list');
Route::get('/admin/promotion',[ShopController::class, 'admin'])->name('admin.promotion');
Route::get('/admin/promotion/create',[ShopController::class, 'createForm'])->name('admin.create-promotion-form');
Route::post('/admin/shop/create',[ShopController::class, 'create'])->name('admin.create-promotion');
Route::get('/shop/{shop}',[ShopController::class, 'show'])->name('shop-view');
Route::get('/admin/shop/{shop}/update',[ShopController::class, 'updateForm'])->name('admin.update-promotion-form');
Route::post('/admin/shop/{shop}/update',[ShopController::class, 'update'])->name('admin.update-promotion');
Route::get('/shop/{shop}/delete',[ShopController::class, 'delete'])->name('admin.delete-promotion');
Route::get('/shop/{shop}/product/add',[ShopController::class, 'addProductForm'])->name('shop-add-product-form');
Route::post('/shop/{shop}/product/add',[ShopController::class, 'addProduct'])->name('shop-add-product');
Route::get('/shop/{shop}/product/{product}/remove',[ShopController::class, 'removeProduct'])->name('shop-remove-product');


Route::get('/product/{product}/shop',[ProductController::class, 'showShop'])->name('product-view-shop');
Route::get('/shop/{shop}/product',[ShopController::class, 'showProduct'])->name('shop-view-product');
Route::get('/category/{category}/product',[CategoryController::class, 'showCategory'])->name('category-view-product');

Route::get('/category', [CategoryController::class, 'list'])->name('category-list');
Route::get('/admin/category',[CategoryController::class, 'admin'])->name('admin.category');
Route::get('/admin/category/create',[CategoryController::class, 'createForm'])->name('admin.create-category-form');
Route::post('/category/create',[CategoryController::class, 'create'])->name('admin.create-category');
Route::get('/category/{category}',[CategoryController::class, 'show'])->name('category-view');
Route::get('/admin/category/{category}/update',[CategoryController::class, 'updateForm'])->name('admin.update-category-form');
Route::post('/category/{category}/update',[CategoryController::class, 'update'])->name('admin.update-category');
Route::get('/category/{category}/delete',[CategoryController::class, 'delete'])->name('admin.delete-category');
Route::get('/category/{category}/product/add',[CategoryController::class, 'addProductForm'])->name('category-add-product-form');
Route::post('/category/{category}/product/add',[CategoryController::class, 'addProduct'])->name('category-add-product');


Route::get('/user', [UserController::class, 'list'])->name('user-list');
Route::get('/admin/user', [UserController::class, 'admin'])->name('admin.user');
Route::get('/user/create',[UserController::class, 'createForm'])->name('admin.create-user-form');
Route::post('/user/create',[UserController::class, 'create'])->name('admin.create-user');
Route::get('/user/{user}',[UserController::class, 'show'])->name('user-view');
Route::get('/user/{user}/update',[UserController::class, 'updateForm'])->name('admin.update-user-form');
Route::post('/user/{user}/update',[UserController::class, 'update'])->name('admin.update-user');
Route::get('/user/{user}/delete',[UserController::class, 'delete'])->name('admin.delete-user');

//Route::get('/admin/product',[AdminController::class, 'list'])->name('admin.product');
//Route::get('/admin/product/create',[AdminController::class, 'createForm'])->name('admin.create-product-form');
//Route::post('/admin/create',[AdminController::class, 'create'])->name('admin.create');
//Route::get('/admin/product/update',[AdminController::class, 'updateForm'])->name('admin.update-form');
//Route::post('/product/{product}/update',[AdminController::class, 'update'])->name('admin.product-update');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home' , [HomeController::class ,'adminHome'])->name('admin.home')->middleware('is_admin');
