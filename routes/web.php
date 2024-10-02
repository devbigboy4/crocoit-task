<?php

use App\Http\Controllers\Frontend\Article\ArticleController;
use App\Http\Controllers\Frontend\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\MyArticle\ArticleController as MyArticleArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-articles',MyArticleArticleController::class)->name('my-articles');

    /** Create Article */
    Route::resource('articles', ArticleController::class);
});

require __DIR__.'/admin.php';

require __DIR__.'/auth.php';
