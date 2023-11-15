<?php

namespace App\Livewire;

use App\Models\Discussion;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class DiscussionPrivate extends Component
{
    use WithPagination;

    #[Computed]
    public function discussions(): Paginator
    {
        return Discussion::onlyPrivate()
            ->withCount('answers')
            ->latest()
            ->simplePaginate();
    }

    public function updatedPage($page): void
    {
        $this->dispatch('page-updated');
    }

    #[Layout('components.layouts.discussions')]
    #[Title('Laravel専用相談所')]
    public function render()
    {
        return view('livewire.discussion-private');
    }
}
