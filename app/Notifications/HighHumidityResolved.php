<?php

namespace App\Notifications;

use App\Humidity;
use App\Trigger;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class HighHumidityResolved extends Notification
{
    use Queueable;

    private $subject = 'High Humidity Resolved';

    public $humidity;
    public $watcher;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Trigger $watcher, Humidity $humidity)
    {
        $this->humidity = $humidity;
        $this->watcher = $watcher;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->success()
            ->subject("Ok: ".$this->subject)
            ->line('High humidity resolved.')
            ->action('Acknowledge', url(route('notifications.read', ['notification' => $this->id])));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'condition' => $this->subject,
            'context' => 'success',
            'recorded_value' => $this->humidity->value,
            'trigger_value' => $this->watcher->trigger_value
        ];
    }
}
