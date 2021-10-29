<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectMemberRequest;
use App\Http\Requests\UpdateProjectMemberRequest;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Repositories\ProjectRepository;
use Illuminate\Http\JsonResponse;

class ProjectMemberController extends Controller
{
    private ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function store(CreateProjectMemberRequest $request, Project $project): JsonResponse
    {
        $member = $this->projectRepository->addMember($project, $request->validated());
        return $this->success($member, 'Project Member Created', 201);
    }

    public function update(UpdateProjectMemberRequest $request, ProjectMember $member): JsonResponse
    {
        $member = $this->projectRepository->updateMember($member, $request->validated());
        return $this->success($member);
    }

    public function destroy(ProjectMember $member): JsonResponse
    {
        $this->projectRepository->deleteMember($member);
        return $this->success();
    }
}
