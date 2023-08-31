<?php

namespace App\Livewire;

use App\Models\Status;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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

        $this->redirect(route('status.show', $this->status), navigate: true);
    }
}
