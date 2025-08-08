<?php

namespace App\Livewire;

use App\Models\Status;
use Livewire\Component;
use Prism\Prism\Prism;
use Prism\Bedrock\Bedrock;

class StatusTrans extends Component
{
    public Status $status;

    protected string $model = 'us.anthropic.claude-sonnet-4-20250514-v1:0';

    public function trans(): void
    {
        $response = Prism::text()
            ->using(Bedrock::KEY, $this->model)
            ->withPrompt($this->prompt())
            ->asText();

        $content = $response->text;

        $this->dispatch('contentTranslated', content: $content);
    }

    protected function prompt(): string
    {
        return collect([
            '次の文章を英語に翻訳してください。',
            '----',
            '# title',
            $this->status->title ?? '',
            '# content',
            $this->status->content,
        ])->join(PHP_EOL);
    }
}
