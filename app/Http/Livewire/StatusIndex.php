<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class StatusIndex extends Component
{
    use WithPagination;

    protected $listeners = ['statusCreated' => 'statusCreated'];

    public function statusCreated(): View
    {
        $this->resetPage();

        return $this->render();
    }

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
