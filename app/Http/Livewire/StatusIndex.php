<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Illuminate\View\View;
use Livewire\Component;

class StatusIndex extends Component
{
    public function render(): View
    {
        return view('livewire.status-index')
            ->with([
                'statuses' => Status::with('user')
                    ->latest()
                    ->simplePaginate(),
            ]);
    }
}
