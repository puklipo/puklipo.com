<?php

namespace App\Http\Livewire;

use App\Models\Status;
use App\View\Components\MainLayout;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Livewire\Component;

class StatusEdit extends Component
{
    use AuthorizesRequests;

    public Status $status;

    protected array $rules = [
        'status.content' => 'required|string',
    ];

    public function mount(Status $status): void
    {
        $this->status = $status;
    }

    /**
     * @throws AuthorizationException
     */
    public function update(): void
    {
        $this->authorize('admin');

        $this->validate();

        $this->status->save();

        $this->redirect(route('status.show', $this->status));
    }

    public function render(): View
    {
        return view('livewire.status-edit')
            ->layout(MainLayout::class);
    }
}
