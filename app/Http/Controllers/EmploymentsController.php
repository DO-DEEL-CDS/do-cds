<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmploymentRequest;
use App\Http\Requests\UpdateEmploymentRequest;
use App\Models\Employment;
use App\Repositories\EmploymentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmploymentsController extends Controller
{
    private EmploymentRepository $employmentRepository;

    public function __construct(EmploymentRepository $employmentRepository)
    {
        $this->authorizeResource(Employment::class, 'job');
        $this->employmentRepository = $employmentRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $jobs = $this->employmentRepository->getLatestJobs($request->all());
        return $this->success($jobs);
    }

    public function store(CreateEmploymentRequest $request): JsonResponse
    {
        $job = $this->employmentRepository->createJob($request->validated());

        return $this->success($job);
    }

    public function show(Employment $job): JsonResponse
    {
        return $this->success($job);
    }

    public function update(UpdateEmploymentRequest $request, Employment $job): JsonResponse
    {
        $job = $this->employmentRepository->updateJob($job, $request->validated());
        return $this->success($job);
    }

    public function destroy(Employment $job): JsonResponse
    {
        $this->employmentRepository->deleteJob($job);
        return $this->success();
    }
}
