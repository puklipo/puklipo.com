<?php

namespace App\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class StatusForm extends Component
{
    use AuthorizesRequests;

    #[Rule('required|string')]
    public string $content = '';

    /**
     * @throws AuthorizationException
     */
    public function create(Request $request): void
    {
        $this->authorize('admin');

        $this->validate();

        $request->user()->statuses()->create([
            'content' => trim($this->content),
        ]);

        $this->reset('content');

        $this->dispatch('statusCreated');
    }

    public function render(): View
    {
        return view('livewire.status-form');
    }
}
