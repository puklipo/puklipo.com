<?php

namespace App\Support\JsonLd;

use JsonLd\ContextTypes\AbstractContext;

class Answer extends AbstractContext
{
    /**
     * Property structure.
     *
     * @var array
     */
    protected $structure = [
        'text' => null,
        'author' => null,
        'datePublished' => null,
        'url' => null,
    ];
}
