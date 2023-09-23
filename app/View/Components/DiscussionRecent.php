<?php

namespace App\View\Components;

use App\Models\Discussion;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class DiscussionRecent extends Component
{
    public Collection $discussions;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->discussions = Discussion::withoutPrivate()
            ->withCount('answers')
            ->latest()
            ->take(30)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.discussion-recent');
    }
}
