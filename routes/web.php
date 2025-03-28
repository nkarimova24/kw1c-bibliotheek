<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
// });

// Route::resource('/admin/dashboard', AdminDashboardController::class, ['as' => 'admin']);

// Route::resource('/admin/books', AdminBookController::class, ['as' => 'admin']);

// Route::resource('/admin/genres', GenreController::class, ['as' => 'admin'])->only(['store']);

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

//resource
    Route::resource('/books', AdminBookController::class);
    Route::resource('/genres', GenreController::class)->only(['store']);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

require __DIR__.'/auth.php';