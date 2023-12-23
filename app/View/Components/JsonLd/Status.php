<?php

namespace App\View\Components\JsonLd;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use JsonLd\Context;
use JsonLd\ContextTypes\Article;
use JsonLd\ContextTypes\Person;

class Status extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public \App\Models\Status $status)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $context = Context::create(Article::class, [
            'author' => [
                '@type' => 'Person',
                'name' => $this->status->user->name,
            ],
            'headline' => $this->status->headline,
            'datePublished' => $this->status->created_at->toISOString(),
            'dateModified' => $this->status->updated_at->toISOString(),
        ]);

        return view('components.json-ld.status')->with(compact('context'));
    }
}
