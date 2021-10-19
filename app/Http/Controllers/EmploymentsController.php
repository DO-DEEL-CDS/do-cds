<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Repositories\EmploymentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmploymentsController extends Controller
{
    private EmploymentRepository $employmentRepository;

    public function __construct(EmploymentRepository $employmentRepository)
    {
        $this->employmentRepository = $employmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $jobs = $this->employmentRepository->getLatestJobs($request->all());
        return $this->success($jobs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request): ?Response
    {
        //
    }

    public function show(Employment $job): JsonResponse
    {
        return $this->success($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Employment  $jobs
     * @return Response
     */
    public function update(Request $request, Employment $jobs): ?Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employment  $jobs
     * @return Response
     */
    public function destroy(Employment $jobs): ?Response
    {
        //
    }
}
