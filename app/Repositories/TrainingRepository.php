<?php

namespace App\Repositories;

use App\Enums\TrainingStatus;
use App\Models\Training;
use Illuminate\Contracts\Pagination\Paginator;

class TrainingRepository extends BaseRepository
{
    /**
     * Instantiate repository
     */
    public function __construct()
    {
        parent::__construct(new Training());
    }

    public function getTrainings(array $search): Paginator
    {
        return Training::query()
            ->search($search)
            ->paginate();
    }

    public function createTraining(array $data): Training
    {
        $data['status'] = TrainingStatus::Approved();
        $user = request()->user();

        $training = $user->training()->create($data);
        $training->resources()->createMany($data['resources']);
        return $this->getTraining($training);
    }

    public function getTraining(Training $training): Training
    {
        return $training->load('resources');
    }

    public function updateTraining(Training $training, array $data): Training
    {
        if (!empty($data['status'])) {
            $data['status'] = TrainingStatus::fromValue($data['status']);
            if ($data['status']->is(TrainingStatus::AttendanceOpened())) {
                $data['attendance_time'] = now();
            }
        }
        $training->update($data);
        return $this->getTraining($training);
    }

    public function deleteTraining(Training $training): void
    {
        $training->delete();
        $training->resources()->delete();
        // $training->attendance()->delete(); // softDeletes so no need to delete attendance (for reference)
    }
}
