<?php

namespace App\Livewire;

use App\Models\Status;
use Livewire\Component;

class StatusVote extends Component
{
    public Status $status;

    public function up(): void
    {
        $key = 'status:up:'.$this->status->id;

        if (cache()->has($key)) {
            cache()->increment($key);
        } else {
            cache()->forever($key, 1);
        }
    }

    public function down(): void
    {
        $key = 'status:down:'.$this->status->id;

        if (cache()->has($key)) {
            cache()->increment($key);
        } else {
            cache()->forever($key, 1);
        }
    }
}
