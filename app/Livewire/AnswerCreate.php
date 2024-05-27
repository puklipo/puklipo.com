<?php

namespace App\Livewire;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AnswerCreate extends Component
{
    public Discussion $discussion;

    #[Validate('required|string')]
    public string $content = '';

    public function mount(Discussion $discussion): void
    {
        $this->discussion = $discussion;
    }

    public function create(Request $request): void
    {
        $this->validate();

        $this->discussion->answers()->create([
            'content' => trim($this->content),
            'user_id' => $request->user()->id ?? null,
        ]);

        $this->redirectRoute('discussion.show', $this->discussion);
    }
}
