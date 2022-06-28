<?php

use App\Http\Controllers\AddtoCartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\ChangePassController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\DatatableController2;
use App\Http\Controllers\DataTableController3;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\ProductContoller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishListController;
use App\Models\AddtoCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\HttpKernel\Profiler\Profiler;

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

Route::get('/', [NewController::class, 'new'])->name('dashboard');
Route::post('datastore', [NewController::class, 'store']);
Route::group(['middleware' => ['IsLogin']], function () {
    Route::get('login', [LoginController::class, 'login'])->name('getLogin');
    Route::post('login', [LoginController::class, 'postLogin'])->name('login');
});
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'store']);
Route::get('logout', [NewController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth', 'UserAuth']], function () {
    Route::get('profile', [ProfileController::class, 'profile'])->name('Profile');
});
Route::post('update/{id}', [ProfileController::class, 'store']);
Route::group(['middleware' => ['AdminAuth']], function () {
    Route::get('admin', [AdminController::class, 'getLogin'])->name('AdminLogin');
});
//datatable query
Route::post('users', [AdminController::class, 'store'])->name('userStore');
Route::get('edit-user/{id}', [AdminController::class, 'edit']);
Route::post('update-user/{id}', [AdminController::class, 'update']);
Route::post('delete-user', [AdminController::class, 'delete']);
Route::post('changeStatus', [AdminController::class, 'changeStatus']);


Route::get('datatable', [DatatableController::class, 'data']);
Route::get('getData', [DatatableController::class, 'getData']);
Route::get('changePassword', [ChangePassController::class, 'changePass'])->name('changePassword');
Route::post('updatePassword', [ChangePassController::class, 'updatePassword'])->name('updatePassword');
Route::get('contactusList', [ContactusController::class, 'contactusList'])->name('contactusList');
Route::get('getmessage', [DatatableController2::class, 'getmessage']);
Route::post('adminMess', [AdminMessageController::class, 'adminMess']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('userTemp', [UserController::class, 'userTemplet']);
});

Route::get('editor', [EditorController::class, 'index']);
Route::post('store', [EditorController::class, 'store']);
Route::post('editor/image_upload', [EditorController::class, 'upload'])->name('upload');
Route::post('update/{id}', [EditorController::class, 'update']);

Route::get('product', [ProductContoller::class, 'product'])->name('product');
Route::post('addProduct', [ProductContoller::class, 'addProduct'])->name('addProduct');
Route::get('viewProduct', [ProductContoller::class, 'viewProduct'])->name('viewProduct');
Route::get('productList', [ProductContoller::class, 'productList'])->name('productList');
Route::get('getList', [DataTableController3::class, 'getList']);
Route::post('editList/{id}', [ProductContoller::class, 'editList'])->name('editList');
Route::post('update_prod/{id}', [ProductContoller::class, 'update']);
Route::post('delete_prod/{id}', [ProductContoller::class, 'delete']);
Route::post('change_status', [ProductContoller::class, 'changeStatus']);

Route::get('load-wish-data', [WishListController::class, 'wishCount']);
Route::get('load-cart-data', [AddtoCartController::class, 'cartCount']);
Route::post('delete-cart-item', [AddtoCartController::class, 'deleteCart']);
Route::post('delete-wish-item', [WishListController::class, 'deleteWishList']);
Route::group(['middleware' => ['auth']], function () {
    Route::post('addtoCart', [AddtoCartController::class, 'addtoCart']);
    Route::get('viewCart', [AddtoCartController::class, 'viewCart'])->name('cart');
    Route::post('addtoWish', [WishListController::class, 'addtoWish']);
    Route::get('wishList', [WishListController::class, 'viewWish'])->name('wishList');
    Route::get('checkout', [CheckOutController::class, 'checkOut'])->name('checkout');
});

Route::get('get-all-session', function () {
    $session = session()->all();
});
Route::get('set-session', function (Request $request) {
    $request->session()->put('user_name', auth()->user()->name);
    $request->session()->put('user_id', auth()->user()->email);
    return redirect('get-all-session');
});

Route::get('distroy-session', function () {
    session()->forget('user_name');
    session()->forget('user_id');
    return redirect('get-all-session');
});
