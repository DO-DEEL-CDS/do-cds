<?php

namespace App\Repositories;

use App\Enums\TrainingStatus;
use App\Models\Roles\Corper;
use App\Models\Training;
use App\Notifications\AttendanceOpened;
use App\Notifications\TrainingStarted;
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
        if (!empty($data['resources'])) {
            $training->resources()->createMany($data['resources']);
        }

        return $this->getTraining($training);
    }

    public function getTraining(Training $training): Training
    {
        return $training->load('resources');
    }

    public function updateTraining(Training $training, array $data): Training
    {
        $sendStartedNotification = $sendAttendanceNotification = false;
        if (!empty($data['status'])) {
            $data['status'] = TrainingStatus::fromValue((int) $data['status']);

            if ($data['status']->is(TrainingStatus::Started) && $training->status->isNot(TrainingStatus::Started)) {
                $sendStartedNotification = true;
            } elseif ($data['status']->is(TrainingStatus::AttendanceOpened) && $training->status->isNot(TrainingStatus::AttendanceOpened)) {
                $sendAttendanceNotification = true;
            }
        }
        $training->update($data);
        $training->refresh();

        if ($sendStartedNotification) {
            Corper::notifyAll(new TrainingStarted($training));
        }

        if ($sendAttendanceNotification) {
            Corper::pushNotifyAll(new AttendanceOpened($training));
        }

        return $this->getTraining($training);
    }

    public function deleteTraining(Training $training): void
    {
        $training->delete();
        $training->resources()->delete();
        $training->attendance()->delete();
    }
}
