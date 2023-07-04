<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryFolderController;
use App\Http\Controllers\AboutThumbnailController;
use App\Http\Controllers\GalleryThumbnailController;
use App\Http\Controllers\ActivityThumbnailController;

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
//     return view('home');
// });
Route::get('/', [HomeController::class, 'index'])->name('login');

Route::resource('/library', CategoryController::class)->middleware('auth');
Route::resource('/books', BookController::class)->middleware('auth');

Route::resource('/about', AboutController::class);
Route::post('/about-thumbnail', [AboutThumbnailController::class, 'uploadCropAbout'])->middleware('auth');

Route::resource('/folder', GalleryFolderController::class);
Route::resource('/gallery', GalleryController::class);
Route::post('/gallery-thumbnail', [GalleryThumbnailController::class, 'uploadCropGallery'])->middleware('auth');

Route::resource('/activity', ActivityController::class);
Route::post('activity-thumbnail', [ActivityThumbnailController::class, 'uploadCropActivity'])->middleware('auth');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);