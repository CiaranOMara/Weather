<?php

namespace App\Notifications;

use App\Temperature;
use App\Trigger;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class HighTemperature extends Notification
{
    use Queueable;

    private $subject= 'High Temperature';

    public $temperature;
    public $watcher;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Trigger $watcher, Temperature $temperature)
    {
        $this->temperature = $temperature;
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
            ->error()
            ->subject("Problem: ".$this->subject)
            ->line('Received a high temperature record!')
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
            'context' => 'danger',
            'recorded_value' => $this->temperature->value,
            'trigger_value' => $this->watcher->trigger_value
        ];
    }
}
