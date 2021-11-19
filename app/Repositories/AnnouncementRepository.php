<?php

namespace App\Repositories;

use App\Models\Announcement;
use App\Models\Roles\Corper;
use App\Models\User;
use App\Notifications\AnnouncementNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AnnouncementRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Announcement());
    }

    public function getAnnouncements(array $search = []): LengthAwarePaginator
    {
        return Announcement::query()->search($search)->paginate();
    }

    public function getAnnouncement(Announcement $announcement): Announcement
    {
        return $announcement;
    }

    public function createAndNotify(array $data): Announcement
    {
        if (empty($data['author_id'])) {
            $data['author_id'] = auth()->id();
        }
        $announcement = Announcement::create($data);

        if ($announcement->user_id !== null) {
            User::whereId($announcement->user_id)->notify(new AnnouncementNotification($announcement));
        }

        $corpMembers = Corper::query();

        if ($announcement->batch !== null && $announcement->year !== null) {
            $corpMembers->year($announcement->year)->batch($announcement->batch->shorValue());
        }

        if ($announcement->year !== null) {
            $corpMembers->year($announcement->year);
        }

        if ($announcement->state_code !== null) {
            $corpMembers->year($announcement->state_code);
        }

        Corper::notifyByQuery(new AnnouncementNotification($announcement), $corpMembers);

        return $announcement;
    }

    public function update(Announcement $announcement, array $data): Announcement
    {
        $announcement->update($data);
        $announcement->refresh();
        return $announcement;
    }

    public function delete(Announcement $announcement): ?bool
    {
        return $announcement->delete();
    }
}
