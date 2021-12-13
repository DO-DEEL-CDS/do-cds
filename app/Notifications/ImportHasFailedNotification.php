<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Maatwebsite\Excel\Events\ImportFailed;

class ImportHasFailedNotification extends Notification
{
    use Queueable;

    private ImportFailed $importFailedEvent;
    private string $importType;

    public function __construct(ImportFailed $event, string $importType)
    {
        $this->importFailedEvent = $event;
        $this->importType = $importType;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject($this->importType . ' Import Failed')
                ->line('The Import Was Unsuccessful.')
                ->line('Log:' . $this->importFailedEvent->getException()->getMessage())
                ->line('Correct the error in the file and try again!');
    }

    public function toArray($notifiable): array
    {
        return [
                'type' => 'import',
                'content' => [
                        'feedback' => 'Import Failed',
                        'reason' => 'Log: ' . $this->importFailedEvent->getException()->getMessage(),
                ],
        ];
    }
}
