<?php

use App\Livewire\DiscussionIndex;
use App\Livewire\DiscussionMy;
use App\Livewire\DiscussionPrivate;
use App\Livewire\DiscussionShow;
use Illuminate\Support\Facades\Route;

Route::get('discussions', DiscussionIndex::class)
    ->name('discussion');

Route::get('discussions/my', DiscussionMy::class)
    ->name('discussion.my')
    ->middleware(['auth', 'verified']);

Route::get('discussions/private', DiscussionPrivate::class)
    ->name('discussion.private')
    ->can('admin');

Route::get('discussions/{discussion}', DiscussionShow::class)
    ->name('discussion.show')
    ->whereUlid('discussion');
