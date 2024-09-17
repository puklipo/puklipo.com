<?php

namespace App\Livewire;

use App\Models\Status;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class StatusIndex extends Component
{
    use WithPagination;

    #[On('statusCreated')]
    public function statusCreated(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function statuses(): Paginator
    {
        return Status::when(
            session()->has('status_filter'),
            fn (Builder $query) => $query->whereIntegerInRaw('user_id', session('status_filter', collect(config('puklipo.users'))
                ->values()
                ->toArray())))
            ->latest()
            ->simplePaginate();
    }
}
