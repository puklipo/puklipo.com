<?php

namespace App\Http\Controllers\Twitter;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TwitterWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): string
    {
        $request->validate([
            'name' => [
                'required',
                Rule::in([config('services.twitter.name')])
            ],
        ]);

        User::find(1)->statuses()->create([
            'content' => trim($request->json('content')),
            'twitter' => trim($request->json('link')),
        ]);

        return 'OK';
    }
}
