<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGmbBusiness;
use App\Http\Requests\UpdateGmbBusiness;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\GmbSubmission;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Services\ImportService;
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
        $this->authorize('viewAny', Project::class);
        $projects = $this->projectRepository->getProjects($request->all());
        return $this->success($projects);
    }

    public function show(Project $project): JsonResponse
    {
        $this->authorize('view', $project);
        return $this->success($this->projectRepository->getProjectData($project));
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);
        $member = $this->projectRepository->updateProject($project, $request->validated());
        return $this->success($member, 'Project Updated');
    }

    public function storeGmbSubmission(storeGmbBusiness $request, Project $project): JsonResponse
    {
        $this->authorize('create', GmbSubmission::class);
        $payload = $request->validated();
        $payload['user_id'] = $request->user()->id;
        $submission = $this->projectService->createGmbSubmission($project, $payload);

        return $this->success($submission, 'submission successful', 201);
    }

    public function UpdateGmbSubmission(GmbSubmission $business, UpdateGmbBusiness $request): JsonResponse
    {
        $this->authorize('update', $business);
        $business = $this->projectRepository->updateBusiness($business, $request->validated());
        return $this->success($business);
    }

    public function getAllGmbSubmissions(Request $request): JsonResponse
    {
        $this->authorize('viewAny', GmbSubmission::class);
        $businesses = $this->projectRepository->getAllBusinesses($request->all());
        return $this->success($businesses);
    }

    public function getGmbSubmission(GmbSubmission $business): JsonResponse
    {
        $this->authorize('view', $business);
        $business->load([
            'corper' => fn($q) => $q->with('profile')
        ]);
        return $this->success($business);
    }

    public function import(Request $request): JsonResponse
    {
        $this->authorize('import', GmbSubmission::class);

        $request->validate(['file' => ['file', 'max:50000', 'mimes:csv,txt']]);
        ImportService::importBusinesses($request);

        return $this->success([], 'Import Queued');
    }
}
