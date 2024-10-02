<?php

use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    require __DIR__.'/admin-auth.php';

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        /** Categories Route */
        Route::get('/categories/trash/', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::put('/categories/restore/{category}', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('/categories/forcedelete/{category}', [CategoryController::class, 'forceDelete'])->name('categories.forcedelete');
        Route::resource('categories', CategoryController::class);

    });
});

