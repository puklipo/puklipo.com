<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class NewToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:new-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new token.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $user = User::findOrFail(config('puklipo.users.tips'));
        $token = $user->createToken('tips');

        $this->info($token->plainTextToken);

        return 0;
    }
}
