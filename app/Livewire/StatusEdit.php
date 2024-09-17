<?php

namespace App\Livewire;

use App\Models\Status;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StatusEdit extends Component
{
    public Status $status;

    #[Validate('required|string')]
    public string $content;

    #[Validate('nullable|string')]
    public ?string $title = '';

    public function mount(Status $status): void
    {
        $this->content = $status->content;
        $this->title = $status->title;
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
            'title' => trim($this->title),
        ])->save();

        $this->redirectRoute('status.show', $this->status, navigate: true);
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(): void
    {
        $this->authorize('admin');

        if ($this->status->attachment?->exists) {
            Storage::delete('audio/'.$this->status->id.'.mp3');
            $this->status->attachment?->delete();
        }

        $this->status->delete();
        unset($this->status);

        $this->redirectRoute('home', navigate: true);
    }
}
