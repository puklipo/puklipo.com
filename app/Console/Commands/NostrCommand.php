<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Revolution\Nostr\Facades\Social;

class NostrCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:nostr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $notes = Social::notes(
            authors: [config('nostr.keys.pk')],
            since: cache('nostr_since', now()->subDays(7)->timestamp),
            limit: 50,
        );

        $user = User::findOrFail(config('puklipo.users.tips'));

        collect($notes)
            ->each(fn ($note) => $user->statuses()->updateOrCreate([
                'nostr_id' => $note['id'],
            ], [
                'content' => $note['content'],
                'created_at' => $note['created_at'],
            ]));

        cache(['nostr_since' => now()->timestamp]);
    }
}
