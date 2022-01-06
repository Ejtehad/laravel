<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\ImageFileController;

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

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::get('locale/{locale}',function($locale){

    Session::put('locale',$locale);

   return redirect()->back();
    })->name('switchLan');  //add name to router

Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');


Route::resource('products', ProductController::class);

Route::get('firebase-phone-authentication', [FirebaseController::class, 'index']);

Route::get('/file-upload', [ImageFileController::class, 'index']);

Route::post('/add-watermark', [ImageFileController::class, 'imageFileUpload'])->name('image.watermark');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
