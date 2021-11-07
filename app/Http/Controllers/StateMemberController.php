<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStateMemberRequest;
use App\Http\Requests\UpdateStateMemberRequest;
use App\Models\State;
use App\Models\StateMember;
use App\Repositories\StateRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function index(Request $request, State $state): JsonResponse
    {
        $state->schedule_officers = $this->stateRepository->getScheduleOfficers($state, $request->all());
        $state->community_managers = $this->stateRepository->getScheduleOfficers($state, $request->all());
        $state->executives = $this->stateRepository->getScheduleOfficers($state, $request->all());

        return $this->success($state);
    }

    public function store(CreateStateMemberRequest $request, State $state): JsonResponse
    {
        $this->authorize('create', $state);
        $member = $this->stateRepository->addMember($state, $request->validated());
        return $this->success($member, 'State Member Created', 201);
    }

    public function update(UpdateStateMemberRequest $request, StateMember $member): JsonResponse
    {
        $member->load('state');
        $this->authorize('create', $member->state);
        $member = $this->stateRepository->updateMember($member, $request->validated());
        return $this->success($member->toArray());
    }

    public function destroy(StateMember $member): JsonResponse
    {
        $member->load('state');
        $this->authorize('create', $member->state);
        $this->stateRepository->deleteMember($member);
        return $this->success();
    }
}
