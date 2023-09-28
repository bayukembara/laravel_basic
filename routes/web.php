<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
//!-- Import Model so we can take users
use App\Models\User;

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
    Route::get('/dashboard', function () {
        // !take a data
        $users = User::all();
        // !Compact is use for to pass the data from $users to dashboard route
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

Route::get('about', function () {
    return view('about');
});

Route::get('contact', [ContactController::class, 'index'])->name('contact');
