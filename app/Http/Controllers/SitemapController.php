<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
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
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create(route('discussion'))->setPriority(1.0));

        Status::latest()->lazy()->each(fn (Status $status) => $sitemap->add(
            Url::create(route('status.show', $status))
                ->setLastModificationDate($status->updated_at)
        ));

        Discussion::onlyPublic()->latest()->lazy()->each(fn (Discussion $discussion) => $sitemap->add(
            Url::create(route('discussion.show', $discussion))
                ->setLastModificationDate($discussion->updated_at)
        ));

        return $sitemap->render();
    }
}
