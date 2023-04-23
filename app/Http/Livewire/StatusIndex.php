<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class StatusIndex extends Component
{
    use WithPagination;

    protected bool $scroll = true;

    protected $listeners = [
        'statusCreated' => 'statusCreated',
        'updatedPage' => 'updatedPage',
    ];

    public function statusCreated(bool $scroll = false): View
    {
        //新規投稿後は自動スクロールしない。
        $this->scroll = $scroll;

        $this->resetPage();

        return $this->render();
    }

    public function updatedPage($page): void
    {
        if (!$this->scroll) {
            return;
        }

        //ページが変わった時に一番上にスクロール。
        $this->dispatchBrowserEvent('page-updated', ['page' => $page]);
    }

    public function render(): View
    {
        return view('livewire.status-index')
            ->with([
                'statuses' => Status::with('user')
                    ->when(session()->has('status_filter'),
                        fn (Builder $query) => $query->whereIntegerInRaw('user_id', session('status_filter', collect(config('puklipo.users'))
                            ->values()
                            ->toArray())))
                    ->latest()
                    ->simplePaginate(),
            ]);
    }
}
