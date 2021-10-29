<?php

namespace App\Repositories;

use App\Enums\StateMembershipType;
use App\Models\State;
use App\Models\StateMember;

class StateRepository extends BaseRepository
{
    /**
     * Instantiate repository
     *
     * @param  State  $model
     */
    public function __construct(State $model)
    {
        parent::__construct($model);
    }

    public function getScheduleOfficers(State $state)
    {
        return $state->members()
            ->type(StateMembershipType::ScheduleOfficer())
            ->get();
    }

    public function getCommunityManagers(State $state)
    {
        return $state->members()
            ->type(StateMembershipType::CommunityManager())
            ->get();
    }

    public function getExecutives(State $state)
    {
        return $state->members()
            ->type(StateMembershipType::CommunityManager())
            ->get();
    }

    public function addMember(State $project, array $data): StateMember
    {
        return $project->members()->create($data);
    }

    public function updateMember(StateMember $stateMember, array $data): StateMember
    {
        $stateMember->update($data);
        $stateMember->refresh();
        return $stateMember;
    }

    public function deleteMember(StateMember $stateMember): ?bool
    {
        return $stateMember->delete();
    }
}
