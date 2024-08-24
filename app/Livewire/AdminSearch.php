<?php

namespace App\Livewire;

use App\Models\Status;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSearch extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Computed]
    public function statuses(): Paginator
    {
        return Status::with('user')
            ->whereAny(['title', 'content'], 'like', "%$this->search%")
            ->latest()
            ->simplePaginate(5);
    }
}
