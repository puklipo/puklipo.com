<?php

namespace App\Support;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class Markdown
{
    /**
     * Parse the given Markdown text into HTML.
     */
    public static function parse(string $text, array $options = []): HtmlString
    {
        $config = array_merge([
            'html_input' => 'allow',
            'renderer' => [
                'soft_break'      => "<br>\n",
            ],
            'allow_unsafe_links' => false,
            'disallowed_raw_html' => [
                'disallowed_tags' => ['title', 'textarea', 'style', 'xmp', 'noembed', 'noframes', 'script', 'plaintext'],
            ],
        ], $options);

        return new HtmlString(Str::markdown($text, $config));
    }
}
