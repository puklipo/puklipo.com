<?php

namespace App\View\Components\JsonLd;

use App\Models\Answer;
use App\Support\JsonLd\Answer as AnswerJson;
use App\Support\JsonLd\QAPage;
use App\Support\JsonLd\Question;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use JsonLd\Context;
use JsonLd\ContextTypes\Person;

class Discussion extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public \App\Models\Discussion $discussion)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->discussion->loadCount('answers');

        $answers = $this->discussion->answers->map(fn (Answer $answer) => Context::create(AnswerJson::class, [
            'text' => $answer->content,
            'author' => Context::create(Person::class, [
                'name' => $answer->user->name ?? '匿名',
            ]),
            'datePublished' => $answer->created_at->toISOString(),
            'url' => route('discussion.show', $this->discussion).'#'.$answer->id,
        ])->getProperties()
        )->toArray();

        $question = Context::create(Question::class, collect([
            'name' => $this->discussion->title,
            'text' => $this->discussion->content,
            'author' => Context::create(Person::class, [
                'name' => $this->discussion->user->name ?? '匿名',
            ]),
            'datePublished' => $this->discussion->created_at->toISOString(),
            'answerCount' => $this->discussion->answers_count,
            'url' => route('discussion.show', $this->discussion),
        ])->when(filled($answers), function (Collection $collection) use ($answers) {
            $collection->put('suggestedAnswer', $answers);
        })->toArray());

        $context = Context::create(QAPage::class, [
            'mainEntity' => $question,
        ]);

        return view('components.json-ld.discussion')->with(compact('context'));
    }
}
