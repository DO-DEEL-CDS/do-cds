<?php

namespace App\Repositories;

use App\Enums\TrainingStatus;
use App\Models\Training;

class TrainingRepository extends BaseRepository
{
    /**
     * Instantiate repository
     */
    public function __construct()
    {
        parent::__construct(new Training());
    }

    public function getUpcomingTraining(): \Illuminate\Contracts\Pagination\Paginator
    {
        return Training::whereTitle('start_time', '>=', now())
            ->orWhere('status', TrainingStatus::Started)
            ->orWhere('status', TrainingStatus::AttendanceOpened)
            ->latest()
            ->simplePaginate();
    }
}
