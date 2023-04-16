<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;

class StatusForm extends Component
{
    public string $content = '';

    protected array $rules = [
        'content' => 'required|string',
    ];

    public function create(Request $request): void
    {
        $this->validate();

        $request->user()->statuses()->create([
            'content' => trim($this->content),
        ]);

        $this->reset('content');
    }

    public function render(): View
    {
        return view('livewire.status-form');
    }
}
