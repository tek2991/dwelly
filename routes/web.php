<?php

use App\Http\Controllers\PublicPageController;
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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [PublicPageController::class, 'index'])->name('home');
    Route::get('/peoperty', [PublicPageController::class, 'propertyIndex'])->name('property.index');
    Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');
    Route::get('/about', [PublicPageController::class, 'about'])->name('about');
    Route::get('/owners', [PublicPageController::class, 'owners'])->name('owners');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
