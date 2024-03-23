<?php

namespace App\Livewire;

use App\Models\Discussion;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DiscussionCreate extends Component
{
    #[Validate('required|string')]
    /**
     * @var string デフォルトバージョン
     */
    public string $version = '11.x';

    #[Locked]
    public array $versions = [
        '11.x',
        '10.x',
    ];

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|string')]
    public string $content = '';

    #[Validate('required|boolean')]
    public bool $private = false;

    /**
     * @throws AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorize('create', Discussion::class);

        $this->validate();

        $discussion = $request->user()->discussions()->create([
            'title' => str($this->title)->squish(),
            'content' => trim($this->content),
            'version' => trim($this->version),
            'private' => $this->private,
        ]);

        return to_route('discussion.show', $discussion);
    }
}
