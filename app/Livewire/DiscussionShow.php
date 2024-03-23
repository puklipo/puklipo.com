<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Discussion;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DiscussionShow extends Component
{
    public Discussion $discussion;

    /**
     * @throws AuthorizationException
     */
    public function mount(): void
    {
        $this->authorize('view', $this->discussion);

        $this->discussion->load(['answers', 'answers.user']);
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(): void
    {
        $this->authorize('delete', $this->discussion);

        $this->discussion->delete();
        unset($this->discussion);

        $this->redirectRoute('discussion');
    }

    /**
     * @throws AuthorizationException
     */
    public function deleteAnswer($id): void
    {
        $this->authorize('delete', $this->discussion);

        Answer::destroy($id);

        $this->discussion->load(['answers', 'answers.user']);

        $this->redirectRoute('discussion.show', $this->discussion);
    }

    #[Layout('components.layouts.discussions')]
    public function render()
    {
        return view('livewire.discussion-show')
            ->title($this->discussion->title);
    }
}
