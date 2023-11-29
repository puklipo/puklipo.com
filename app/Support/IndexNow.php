<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class IndexNow
{
    public static function submit(string $url): void
    {
        if (! app()->isProduction()) {
            return;
        }

        Http::get(config('indexnow.search_engine'), [
            'url' => $url,
            'key' => config('indexnow.key'),
        ]);
    }
}
