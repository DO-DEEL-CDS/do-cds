<?php

namespace App\Repositories;

use App\Enums\TrainingStatus;
use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Models\User;

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

    // Your methods for repository
    public function recordAttendance(Training $training, User $user)
    {
        abort_if($training->status->isNot(TrainingStatus::AttendanceOpened), 400, 'Training attendance is not Open');
        return $training->attendance()->updateOrCreate([
            'user_id' => $user->id
        ]);
    }
}
