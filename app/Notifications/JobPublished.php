<?php

namespace App\Notifications;

use App\Models\Employment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class JobPublished extends Notification
{
    use Queueable;

    private Employment $job;

    /**
     * Create a new notification instance.
     *
     * @param  Employment  $job
     * @return void
     */
    public function __construct(Employment $job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [OneSignalChannel::class];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
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

    public function toOneSignal($notifiable): OneSignalMessage
    {
        return OneSignalMessage::create()
            ->setSubject('Training Attendance Opened')
            ->setBody($this->job->title)
            ->setData('job', $this->job);
    }
}
