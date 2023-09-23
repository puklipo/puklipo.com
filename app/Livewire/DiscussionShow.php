<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Discussion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DiscussionShow extends Component
{
    use AuthorizesRequests;

    public Discussion $discussion;

    public function mount(): void
    {
        $this->authorize('view', $this->discussion);

        $this->discussion->load(['answers', 'answers.user']);
    }

    public function delete()
    {
        $this->authorize('delete', $this->discussion);

        $this->discussion->delete();
        unset($this->discussion);

        return to_route('discussion');
    }

    public function deleteAnswer($id)
    {
        $this->authorize('delete', $this->discussion);

        Answer::destroy($id);
        $this->discussion->load(['answers', 'answers.user']);

        return to_route('discussion.show', $this->discussion);
    }

    #[Layout('components.layouts.discussions')]
    public function render()
    {
        return view('livewire.discussion-show')
            ->title($this->discussion->title);
    }
}
