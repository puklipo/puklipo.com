<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): string
    {
        return response(Storage::get('sitemap.xml'), 200, [
            'Content-Type' => 'application/xml; charset="UTF-8"',
        ]);
    }
}
