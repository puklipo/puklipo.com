<?php

namespace App\Jobs;

use App\Models\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create(route('discussion')));

        Status::latest()->lazy()->each(fn (Status $status) => $sitemap->add(
            Url::create(route('status.show', $status))
                ->setLastModificationDate($status->updated_at)
        ));

        $sitemap->writeToDisk(config('filesystems.default'), 'sitemap.xml');
    }
}
