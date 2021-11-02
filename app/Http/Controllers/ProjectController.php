<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGmbBusiness;
use App\Http\Requests\UpdateGmbBusiness;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\GmbSubmission;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private ProjectRepository $projectRepository;
    private ProjectService $projectService;

    public function __construct(ProjectRepository $projectRepository, ProjectService $projectService)
    {
        $this->projectRepository = $projectRepository;
        $this->projectService = $projectService;
    }

    public function index(Request $request): JsonResponse
    {
        $projects = $this->projectRepository->getProjects($request->all());
        return $this->success($projects);
    }

    public function show(Project $project): JsonResponse
    {
        return $this->success($this->projectRepository->getProjectData($project));
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $member = $this->projectRepository->updateProject($project, $request->validated());
        return $this->success($member, 'Project Updated');
    }

    public function storeGmbSubmission(storeGmbBusiness $request, Project $project): JsonResponse
    {
        $payload = $request->validated();
        $payload['user_id'] = $request->user()->id;
        $submission = $this->projectService->createGmbSubmission($project, $payload);

        return $this->success($submission, 'submission successful', 201);
    }

    public function UpdateGmbSubmission(GmbSubmission $business, UpdateGmbBusiness $request): JsonResponse
    {
        $business = $this->projectRepository->updateBusiness($business, $request->validated());
        return $this->success($business);
    }

    public function getAllGmbSubmissions(Request $request): JsonResponse
    {
        $businesses = $this->projectRepository->getAllBusinesses($request->all());
        return $this->success($businesses);
    }

    public function getGmbSubmission(GmbSubmission $business): JsonResponse
    {
        return $this->success($business);
    }
}
