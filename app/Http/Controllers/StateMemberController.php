<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\StateMember;
use App\Repositories\StateRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  StateMember  $stateMember
     * @return Response
     */
    public function show(StateMember $stateMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  StateMember  $stateMember
     * @return Response
     */
    public function update(Request $request, StateMember $stateMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  StateMember  $stateMember
     * @return Response
     */
    public function destroy(StateMember $stateMember)
    {
        //
    }
}
