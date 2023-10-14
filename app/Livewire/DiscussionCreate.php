<?php

namespace App\Livewire;

use App\Models\Discussion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class DiscussionCreate extends Component
{
    use AuthorizesRequests;

    #[Rule('required|string')]
    /**
     * @var string $version デフォルトバージョン
     */
    public string $version = '10.x';

    #[Locked]
    public array $versions = [
        '11.x',
        '10.x',
        '9.x',
    ];

    #[Rule('required|string|max:255')]
    public string $title = '';

    #[Rule('required|string')]
    public string $content = '';

    #[Rule('required|boolean')]
    public bool $private = false;

    public function create(Request $request)
    {
        $this->authorize('create', Discussion::class);

        $this->validate();

        $discussion = $request->user()->discussions()->create([
            'title' => trim($this->title),
            'content' => trim($this->content),
            'version' => trim($this->version),
            'private' => $this->private,
        ]);

        return to_route('discussion.show', $discussion);
    }

    public function render()
    {
        return view('livewire.discussion-create');
    }
}
