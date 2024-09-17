<?php

namespace App\Livewire;

use App\Models\Status;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class StatusAudio extends Component
{
    public Status $status;

    public function create(): void
    {
        $this->authorize('admin');

        $response = OpenAI::audio()->speech([
            'model' => 'tts-1',
            'input' => $this->status->title.PHP_EOL.$this->status->content,
            'voice' => 'alloy',
        ]);

        Storage::put($path = 'audio/'.$this->status->id.'.mp3', $response, 'public');

        $this->status->attachment()->updateOrCreate([
            'file' => $path,
        ], [
            'type' => 'audio/mp3',
            'length' => strlen($response),
        ]);

        $this->redirectIntended();
    }

    public function delete(): void
    {
        $this->authorize('admin');

        Storage::delete('audio/'.$this->status->id.'.mp3');
        $this->status->attachment?->delete();

        $this->redirectIntended();
    }

    public function render()
    {
        return view('livewire.status-audio');
    }
}
