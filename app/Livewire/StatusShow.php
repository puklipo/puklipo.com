<?php

namespace App\Livewire;

use App\Models\Status;
use Illuminate\View\View;
use Livewire\Component;

class StatusShow extends Component
{
    public Status $status;

    public function render(): View
    {
        $title = $this->status->headline;

        $description = str($this->status->content)->replace(PHP_EOL, ' ')->truncate(150)->value();

        return view('livewire.status-show')
            ->layoutData(compact('description'))
            ->title($title);
    }
}
