<?php

use Illuminate\Support\Facades\Route;

Route::get(config('indexnow.key').'.txt', function () {
    return response(content: config('indexnow.key'));
});
