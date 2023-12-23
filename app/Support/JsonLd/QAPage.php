<?php

namespace App\Support\JsonLd;

use JsonLd\ContextTypes\AbstractContext;

class QAPage extends AbstractContext
{
    /**
     * Property structure.
     *
     * @var array
     */
    protected $structure = [
        'mainEntity' => Question::class,
    ];
}
