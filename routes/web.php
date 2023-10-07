<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
//!-- Import Model so we can take users
use Illuminate\Support\Facades\DB;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', function () {
        // !take a data
        //? $users = User::all();
        // !Compact is use for to pass the data from $users to dashboard route
        // ? and we can use another way like below
        $users = DB::table('users')->get();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

// * Category Route
Route::get('category/all', [CategoryController::class, 'allCat'])->name('all.category');
Route::post('category/add', [CategoryController::class, 'store'])->name('store.category');
// & ORM
// * Load the data to the form
Route::get('category/edit/{id}', [CategoryController::class, 'edit']);
Route::get('category/softdelete/{id}', [CategoryController::class, 'softdelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('category/permdelete/{id}', [CategoryController::class, 'permdelete']);
// * Route to update the data from the edit
Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('update.category');

// *Brand Route
Route::get('brand/all', [BrandController::class, 'index'])->name('all.brand');
Route::post('brand/add', [BrandController::class, 'store'])->name('store.brand');

Route::get('about', function () {
    return view('about');
});

Route::get('contact', [ContactController::class, 'index'])->name('contact');
