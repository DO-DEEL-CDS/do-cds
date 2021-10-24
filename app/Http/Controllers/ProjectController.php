<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $projects = $this->projectRepository->getProjects();
        return $this->success($projects);
    }

    public function show(Project $project): JsonResponse
    {
        return $this->success($this->projectRepository->getProjectData($project));
    }
}
