<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;

class ImportSuccessNotification extends Notification
{
    use Queueable;

    private AfterImport $import;
    private string $importType;

    public function __construct(AfterImport $event, string $importType)
    {
        $this->import = $event;
        $this->importType = $importType;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject($this->importType . ' Import Completed')
                ->line('The Import has Been Completed.')
                ->line('Total Rows with Errors not imported: ' . $this->failuresCount());
    }

    public function failuresCount(): int
    {
        $looped = [];
        $count = 0;
        /** @var Failure $failure */
        foreach ($this->import->getConcernable()->failures() as $failure) {
            if (!in_array($failure->row(), $looped, true)) {
                $count++;
            }
            $looped[] = $failure->row();
        }
        return $count;
    }

    public function toArray($notifiable): array
    {
        return [
                'type' => 'import',
                'content' => [
                        'feedback' => 'Import Completed',
                ],
        ];
    }
}
