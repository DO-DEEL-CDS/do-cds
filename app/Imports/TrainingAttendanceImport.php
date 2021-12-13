<?php

namespace App\Imports;

use App\Models\Roles\Admin;
use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Models\User;
use App\Notifications\ImportSuccessNotification;
use App\Rules\NyscStateCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;

class TrainingAttendanceImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithUpserts, WithChunkReading, WithEvents,
                                          SkipsOnFailure,
                                          ShouldQueue
{
    use SkipsFailures;

    private Training $training;

    /**
     * @param  Training  $training
     */
    public function __construct(Training $training)
    {
        $this->training = $training;
    }

    /**
     * @param  array  $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        $user = User::whereEmail($row['email'])->orWhereHas('profile', function ($query) use ($row) {
            $query->where('nysc_state_code', $row['nysc_state_code']);
        })->first(['id']);

        if ($user === null) {
            return null;
        }
        return new TrainingAttendance([
                'user_id' => $user->id,
                'training_id' => $this->training->id
        ]);
    }

    public function batchSize(): int
    {
        return 200;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [
                AfterImport::class => function (AfterImport $event) {
                    Admin::notifyAll(new ImportSuccessNotification($event, 'Attendance'));
                },
        ];
    }

    public function uniqueBy(): string
    {
        return 'user_id';
    }

    public function rules(): array
    {
        return [
                'email' => ['required', 'email'],
                'nysc_state_code' => ['required', new NyscStateCode(), 'exists:profile'],
        ];
    }
}
