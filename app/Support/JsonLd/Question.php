<?php

namespace App\Support\JsonLd;

use JsonLd\ContextTypes\AbstractContext;
use JsonLd\ContextTypes\Person;

class Question extends AbstractContext
{
    /**
     * Property structure.
     *
     * @var array
     */
    protected $structure = [
        'name' => null,
        'text' => null,
        'author' => Person::class,
        'answerCount' => null,
        'suggestedAnswer' => Answer::class,
        'datePublished' => null,
        'url' => null,
    ];

    protected function setSuggestedAnswerAttribute($items)
    {
        if (is_array($items) === false) {
            return $items;
        }

        return array_map(function ($item) {
            return $this->getNestedContext(Answer::class, $item);
        }, $items);
    }
}
