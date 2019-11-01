<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TopicComing extends Notification
{
    use Queueable;

    private $topic;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello!')
                    ->subject ('Your Lightning Topic coming tomorrow : '.$this->topic->subject)
                    ->line("You created a  Lightning talks's topic.")
                    ->line("This one is due tommorrow.")
                    ->line('Name : '.$this->topic->subject)
                    ->line('Content : \r\n'.$this->topic->description)
                    ->action('Topic link', url('/admin/topics'))
                    ->line('Thank you for using our application!');                
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
