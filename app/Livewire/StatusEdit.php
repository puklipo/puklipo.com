<?php

namespace App\Livewire;

use App\Models\Status;
use App\View\Components\MainLayout;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class StatusEdit extends Component
{
    use AuthorizesRequests;

    public Status $status;

    #[Rule('required|string')]
    public string $content;

    public function mount(Status $status): void
    {
        $this->status = $status;
        $this->content = $status->content;
    }

    /**
     * @throws AuthorizationException
     */
    public function update(): void
    {
        $this->authorize('admin');

        $this->validate();

        $this->status->fill([
            'content' => trim($this->content),
        ])->save();

        $this->redirect(route('status.show', $this->status));
    }

    public function render(): View
    {
        return view('livewire.status-edit')
            ->layout(MainLayout::class);
    }
}
