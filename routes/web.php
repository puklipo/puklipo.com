<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Livewire\StatusEdit;
use App\Livewire\StatusIndex;
use App\Livewire\StatusShow;
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

Route::get('/', StatusIndex::class)->name('home');

Route::get('status/{status}', StatusShow::class)
    ->name('status.show')
    ->whereUlid('status');
Route::get('status/{status}/edit', StatusEdit::class)
    ->can('admin')
    ->name('status.edit')
    ->whereUlid('status');

require __DIR__.'/discussion.php';

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

require __DIR__.'/indexnow.php';
