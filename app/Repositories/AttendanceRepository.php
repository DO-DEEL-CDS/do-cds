<?php

namespace App\Repositories;

use App\Enums\TrainingStatus;
use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

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
        abort_unless(
            ($training->status->isNot(TrainingStatus::Closed) && $training->attendance_time->isPast()) ||
            $user->hasPermissionTo('manage-attendance'),
            400,
            'Training attendance is not Open'
        );

        return $training->attendance()->updateOrCreate([
            'user_id' => $user->id
        ]);
    }
}
