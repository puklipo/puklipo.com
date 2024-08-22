<?php

namespace App\Support;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class IndexNow
{
    /**
     * @throws RuntimeException
     */
    public static function submit(string $url): int
    {
        if (blank($key = config('indexnow.key'))) {
            throw new RuntimeException('Missing index now key.');
        }

        return Http::get(config('indexnow.search_engine'), [
            'url' => $url,
            'key' => $key,
        ])->status();
    }

    public static function submitIf(bool $boolean, string $url): int
    {
        return static::submitUnless(! $boolean, $url);
    }

    public static function submitUnless(bool $boolean, string $url): int
    {
        if ($boolean) {
            return 0;
        }

        return static::submit($url);
    }

    public static function fake(array|callable|null $callback = null): Factory
    {
        return Http::fake($callback);
    }
}
