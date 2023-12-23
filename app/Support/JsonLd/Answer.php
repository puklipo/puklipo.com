<?php

namespace App\Support\JsonLd;

use JsonLd\ContextTypes\AbstractContext;
use JsonLd\ContextTypes\Person;

class Answer extends AbstractContext
{
    /**
     * Property structure.
     *
     * @var array
     */
    protected $structure = [
        'text' => null,
        'author' => Person::class,
        'datePublished' => null,
        'url' => null,
    ];
}
