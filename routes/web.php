<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Models\Link;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'check.status'])->group(function () {
    
    Route::get('/dashboard', function () {
        $userId = Auth::id();
        $totalLinks = Link::where('user_id', $userId)->count();
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $recentLinks = Link::with('category')->where('user_id', $userId)->latest()->take(5)->get();
        return view('dashboard', compact('totalLinks', 'totalCategories', 'totalTags', 'recentLinks'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/links', [LinkController::class, 'index'])->name('links.index');
    Route::get('/links/{link}', [LinkController::class, 'show'])->name('links.show');
    Route::post('/links/{link}/toggle-favorite', [LinkController::class, 'toggleFavorite'])->name('links.toggleFavorite');

    Route::middleware('role:admin,editor')->group(function () {
        Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
        Route::post('/links', [LinkController::class, 'store'])->name('links.store');
        Route::get('/links/{link}/edit', [LinkController::class, 'edit'])->name('links.edit');
        Route::put('/links/{link}', [LinkController::class, 'update'])->name('links.update');
        Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
        Route::post('/links/{link}/share', [LinkController::class, 'share'])->name('links.share');
        
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
    });

    Route::middleware('role:admin')->group(function () {
        Route::delete('/links/{id}/force', [LinkController::class, 'forceDelete'])->name('links.forceDelete');
    });
});

require __DIR__.'/auth.php';