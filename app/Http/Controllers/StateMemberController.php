<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStateMemberRequest;
use App\Http\Requests\UpdateStateMemberRequest;
use App\Models\State;
use App\Models\StateMember;
use App\Repositories\StateRepository;
use Illuminate\Http\JsonResponse;

class StateMemberController extends Controller
{
    private StateRepository $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  State  $state
     * @return JsonResponse
     */
    public function index(State $state): JsonResponse
    {
        $state->schedule_officers = $this->stateRepository->getScheduleOfficers($state);
        $state->community_managers = $this->stateRepository->getScheduleOfficers($state);
        $state->executives = $this->stateRepository->getScheduleOfficers($state);

        return $this->success($state);
    }

    public function store(CreateStateMemberRequest $request, State $state): JsonResponse
    {
        $member = $this->stateRepository->addMember($state, $request->validated());
        return $this->success($member, 'State Member Created', 201);
    }

    public function update(UpdateStateMemberRequest $request, StateMember $member): JsonResponse
    {
        $member = $this->stateRepository->updateMember($member, $request->validated());
        return $this->success($member->toArray());
    }

    public function destroy(StateMember $member): JsonResponse
    {
        $this->stateRepository->deleteMember($member);
        return $this->success();
    }
}
