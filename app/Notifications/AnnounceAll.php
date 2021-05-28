<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class AnnounceAll extends Notification implements ShouldQueue
{
    use Queueable;

    private $address;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($address)
    {
        $this->address = $address;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->from('Ghost', ':ghost:')
            ->to('random')
            ->content('Notification for '.$this->address);
    }

}
