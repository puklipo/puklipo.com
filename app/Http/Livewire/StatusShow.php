<?php

namespace App\Http\Livewire;

use App\Models\Status;
use App\View\Components\MainLayout;
use Illuminate\View\View;
use Livewire\Component;

class StatusShow extends Component
{
    public Status $status;

    public function mount(Status $status): void
    {
        $this->status = $status;
    }

    public function render(): View
    {
        $title = str($this->status->content)->replace(PHP_EOL, ' ')->truncate(30)->value();
        //$title .= ' | '.$this->status->user->name;

        $description = str($this->status->content)->replace(PHP_EOL, ' ')->truncate(200)->value();

        return view('livewire.status-show')
            ->layout(MainLayout::class, compact('title', 'description'));
    }
}
