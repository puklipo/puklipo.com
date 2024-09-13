<?php

namespace App\Notifications;

use App\Models\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Revolution\Bluesky\Embed\External;
use Revolution\Bluesky\Notifications\BlueskyChannel;
use Revolution\Bluesky\Notifications\BlueskyMessage;
use Revolution\Laravel\Notification\DiscordWebhook\DiscordChannel;
use Revolution\Laravel\Notification\DiscordWebhook\DiscordMessage;
use Revolution\Threads\Notifications\ThreadsChannel;
use Revolution\Threads\Notifications\ThreadsMessage;

class StatusCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Status $status)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return collect()
            ->when($this->status->user_id === config('puklipo.users.admin'), function (Collection $collection) {
                $collection->push(BlueskyChannel::class, ThreadsChannel::class, DiscordChannel::class);
            })->toArray();
    }

    public function toBluesky(object $notifiable): BlueskyMessage
    {
        $text = $this->status->headline;

        $card = External::create(
            title: $text,
            description: '...',
            uri: route('status.show', $this->status),
        );

        return BlueskyMessage::create(text: $text)
            ->embed($card);
    }

    public function toThreads(object $notifiable): ThreadsMessage
    {
        $text = $this->status->headline.PHP_EOL;
        $text .= route('status.show', $this->status);

        return ThreadsMessage::create(text: $text);
    }

    public function toDiscordWebhook(object $notifiable): DiscordMessage
    {
        return DiscordMessage::create()
            ->embeds([[
                'title' => $this->status->headline,
                'description' => Str::truncate($this->status->content),
                'url' => route('status.show', $this->status),
            ]]);
    }
}
