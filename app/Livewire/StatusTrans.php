<?php

namespace App\Livewire;

use App\Chat\Prompt;
use App\Models\Status;
use Illuminate\Support\Arr;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class StatusTrans extends Component
{
    public Status $status;

    public function trans(): void
    {
        $response = OpenAI::chat()->create(
            Prompt::make(
                system: 'You are Laravel mentor.',
                prompt: $this->prompt(),
            )->toArray()
        );

        $content = trim(Arr::get($response, 'choices.0.message.content'));

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
