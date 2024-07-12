<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SigninController;
use App\Models\Producto;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layout.catalog');
// });

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', [CatalogController::class, 'muestras'])->name('home');
Route::get('/home', [CatalogController::class, 'muestras'])->name('home');

// http://localhost/e-commerce-laravel/distriliquidos/public/catalog

// Rutas para el catálogo
Route::get('/catalog', [CatalogController::class, 'catalog'])->name('catalog');
Route::get('/catalog/marcas', [CatalogController::class, 'getMarcas'])->name('catalog.marcas');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.post');
Route::post('/logout', [LoginController::class, 'postLogout'])->name('logout');
Route::get('/logoutMessage', function () {
    return view('logoutMessage');
})->name('logoutMessage');

// Asegúrate de que esta ruta sea una 'get' si vas a redirigir después del login
Route::get('/userPanel', [LoginController::class, 'userPanel'])->name('user.panel');
Route::get('/adminPanel', [LoginController::class, 'adminPanel'])->name('admin.panel');

Route::get('/user/list', [AdminController::class, 'listUser'])->name('user.list');

Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.updateUser');
Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');

Route::get('/signin', [LoginController::class, 'getSignin'])->name('signin');
Route::post('/signin', [LoginController::class, 'postSignin'])->name('signin.post');

// Rutas para el carrito de compras
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove', [CartController::class, '3'])->name('cart.redirect');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');

Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/admin/base', [AdminController::class, 'showAdminBase'])->name('admin.base');

Route::post('/order/create', [OrderController::class, 'create'])->name('order.create');

Route::POST('/order/captureDetails', [OrderController::class, 'captureOrder'])->name('order.captureD');
// Route::post('/signin', [SigninController::class, 'postSignin'])->name('signin.post');

// Route::get('/carrito', [CartController::class, 'viewCart'])->name('carrito');