<?php

namespace App\Notifications;

use App\Models\Status;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use Revolution\Bluesky\Notifications\BlueskyChannel;
use Revolution\Bluesky\Notifications\BlueskyMessage;

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
            ->when($this->status->user_id === config('puklipo.users.admin') && app()->isProduction(), function (Collection $collection) {
                $collection->push(BlueskyChannel::class);
            })->toArray();
    }

    public function toBluesky(object $notifiable): BlueskyMessage
    {
        $text = $this->status->headline;
        $link = route('status.show', $this->status);

        return BlueskyMessage::create(text: $text)
            ->text(text: PHP_EOL)
            ->link(text: $link, uri: $link);
    }
}
