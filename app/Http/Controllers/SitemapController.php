<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): string
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0));

        User::find(1)->statuses()->latest()->lazy()->each(fn (Status $status) => $sitemap->add(
            Url::create(route('status.show', $status))
                ->setLastModificationDate($status->updated_at)
        ));

        return $sitemap->render();
    }
}
