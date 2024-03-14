<?php

use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;

Route::get('up', function () {
    Event::dispatch(new DiagnosingHealth);

    return View::file(__DIR__.'/../vendor/laravel/framework/src/Illuminate/Foundation/resources/health-up.blade.php');
});
