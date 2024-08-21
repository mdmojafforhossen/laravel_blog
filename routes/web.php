<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

// Frontend Route Start
Route::get('/','App\Http\Controllers\Frontend\FrontendController@homepage');
Route::get('/contact','App\Http\Controllers\Frontend\FrontendController@contact')->name('name.contact');
Route::get('/category','App\Http\Controllers\Frontend\FrontendController@category')->name('name.category');
// Backend Route Start
Route::group(['prefix'=>'admin'],function(){
    Route::get('/dashboard','App\Http\Controllers\Backend\BackendController@dashboard')->name('name.dashboard');
    // category route
    Route::group(['prefix'=>'category'],function(){
    Route::get('manage','App\Http\Controllers\Backend\CategoryController@manage')->name('category.manage');
    });
});
// -------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
