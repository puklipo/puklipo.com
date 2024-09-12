<?php

namespace App\Support;

use Revolution\Threads\Facades\Threads;

class ThreadsToken
{
    public function get(): string
    {
        $token = cache('threads.token', config('services.threads.token'));

        $refresh = Threads::token($token)->refreshToken()['access_token'];

        cache()->forever('threads.token', $refresh);

        return $refresh;
    }
}
