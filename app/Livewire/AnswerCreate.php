<?php

namespace App\Livewire;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AnswerCreate extends Component
{
    public Discussion $discussion;

    #[Rule('required|string')]
    public string $content = '';

    public function mount(Discussion $discussion): void
    {
        $this->discussion = $discussion;
    }

    public function create(Request $request)
    {
        $this->validate();

        $this->discussion->answers()->create([
            'content' => trim($this->content),
            'user_id' => auth()->user()->id ?? null,
        ]);

        return to_route('discussion.show', $this->discussion);
    }

    public function render()
    {
        return view('livewire.answer-create');
    }
}
