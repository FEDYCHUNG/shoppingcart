<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';

Route::get('/', [ClientController::class, 'home']);

Route::get('/shop/{id?}', [ClientController::class, 'shop'])->name("shop");
Route::post('/addtocart/{id}', [ClientController::class, 'addToCart'])->name("addtocart");
Route::put('/update_qty/{id}', [ClientController::class, 'updateQty'])->name("update_qty");
Route::delete("/remove_from_cart/{id}", [ClientController::class, 'removeFromCart'])->name("remove_from_cart");

Route::get('/cart', [ClientController::class, 'cart']);
Route::get('/checkout', [ClientController::class, 'checkout']);
Route::get('/login', [ClientController::class, 'login'])->name("login");
Route::get('/logout', [ClientController::class, 'logout'])->name("logout");
Route::get('/signup', [ClientController::class, 'signup'])->name("signup");
Route::post('/create_account', [ClientController::class, 'createAccount'])->name("create_account");


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('addcategory', [CategoryController::class, 'addcategory'])->name('addcategory');
        Route::post('savecategory', [CategoryController::class, 'saveCategory'])->name('savecategory');

        Route::get('categories', [CategoryController::class, 'categories'])->name('categories');
        Route::get('editcategory/{id}', [CategoryController::class, 'editCategory'])->name('editcategory');
        Route::put('updatecategory', [CategoryController::class, 'udpateCategory'])->name('updatecategory');
        Route::delete('deletecategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deletecategory');
    });

    route::prefix('sliders')->name('sliders.')->group(function () {
        Route::get('addslider', [SliderController::class, 'addslider'])->name('addslider');
        Route::post("saveslider", [SliderController::class, 'saveSlider'])->name('saveslider');

        Route::get('sliders', [SliderController::class, 'sliders'])->name('sliders');
        Route::get('editslider/{id}', [SliderController::class, 'editSlider'])->name('editslider');
        Route::put('active_unactive_slider/{id}/{status_update}', [SliderController::class, 'activeUnactiveSlider'])->name('active_unactive_slider');
        Route::put('updateslider', [SliderController::class, 'updateSlider'])->name('updateslider');

        Route::delete('deleteslider/{id}', [SliderController::class, 'deleteSlider'])->name('deleteslider');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('addproduct', [ProductController::class, 'addproduct'])->name('addproduct');
        Route::post('saveproduct', [ProductController::class, 'saveProduct'])->name('saveproduct');

        Route::get('products', [ProductController::class, 'products'])->name('products');
        Route::get('editproduct/{id}', [ProductController::class, 'editProduct'])->name('editproduct');
        Route::put('updateproduct', [ProductController::class, 'updateProduct'])->name('updateproduct');
        Route::put('active_unactive_product/{id}/{status_update}', [ProductController::class, 'activeUnactiveProduct'])->name('active_unactive_product');

        Route::delete('deleteproduct/{id}', [ProductController::class, 'deleteProduct'])->name('deleteproduct');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('orders', [ClientController::class, 'orders'])->name('orders');
    });
});