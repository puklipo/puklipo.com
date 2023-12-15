<?php

namespace App\Livewire;

use App\Models\Discussion;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.discussions')]
#[Title('Laravel専用相談所')]
class DiscussionIndex extends Component
{
    use WithPagination;

    #[Computed]
    public function discussions(): Paginator
    {
        return Discussion::onlyPublic()
            ->withCount('answers')
            ->latest()
            ->simplePaginate();
    }
}
