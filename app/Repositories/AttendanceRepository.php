<?php

namespace App\Repositories;

use App\Enums\TrainingStatus;
use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class AttendanceRepository extends BaseRepository
{
    /**
     * Instantiate repository
     *
     */
    public function __construct()
    {
        parent::__construct(new TrainingAttendance());
    }

    public function recordAttendance(Training $training, User $user): Model
    {
        abort_if($training->status->is(TrainingStatus::Closed), Response::HTTP_BAD_REQUEST, 'The training attendance has been closed');

        abort_if($training->status->is(TrainingStatus::Approved), Response::HTTP_BAD_REQUEST, 'The training is yet to start');

        abort_unless($this->canTakeAttendance($training), Response::HTTP_BAD_REQUEST, 'Attendance is not Open');

        return $training->attendance()->updateOrCreate([
            'user_id' => $user->id
        ]);
    }

    public function canTakeAttendance(Training $training): bool
    {
        return $training->status->is(TrainingStatus::AttendanceOpened()) ||
            ($training->attendance_time->isPast() && $training->status->in([TrainingStatus::Started(), TrainingStatus::AttendanceOpened()]));
    }
}
