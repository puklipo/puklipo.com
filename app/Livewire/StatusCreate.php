<?php

namespace App\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StatusCreate extends Component
{
    #[Validate('required|string')]
    public string $content = '';

    #[Validate('nullable|string')]
    public ?string $title = '';

    #[On('contentTranslated')]
    public function contentTranslated(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @throws AuthorizationException
     */
    public function create(Request $request): void
    {
        if (Gate::none(['admin', 'tips'])) {
            throw new AuthorizationException;
        }

        $this->validate();

        $request->user()->statuses()->create([
            'content' => trim($this->content),
            'title' => trim($this->title),
        ]);

        $this->reset('content', 'title');

        $this->dispatch('statusCreated');
    }
}
