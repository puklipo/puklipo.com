<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('status', function (Request $request) {
    info($request->user()->name);

    $request->validate([
        'content' => ['required'],
    ]);

    return $request->user()->statuses()->create([
        'content' => $request->input('content'),
        'title' => $request->input('title'),
    ]);
})->middleware('auth:sanctum')
    ->can('tips');
