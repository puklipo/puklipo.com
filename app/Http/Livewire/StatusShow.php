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
        return view('livewire.status-show')
            ->layout(MainLayout::class);
    }
}
