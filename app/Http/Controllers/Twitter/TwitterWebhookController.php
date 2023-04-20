<?php

namespace App\Http\Controllers\Twitter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TwitterWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): string
    {
        $request->user()->statuses()->create([
            'content' => trim($request->json('content')),
            'twitter' => trim($request->json('link')),
        ]);

        return 'OK';
    }
}
