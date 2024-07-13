<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Livewire\StatusEdit;
use App\Livewire\StatusIndex;
use App\Livewire\StatusShow;
use Illuminate\Support\Facades\Route;

Route::get('/', StatusIndex::class)->name('home');

Route::get('status/{status}', StatusShow::class)
    ->name('status.show')
    ->whereUlid('status');
Route::get('status/{status}/edit', StatusEdit::class)
    ->can('admin')
    ->name('status.edit')
    ->whereUlid('status');

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('sitemap', SitemapController::class)->name('sitemap');

Route::feeds();

require __DIR__.'/auth.php';
