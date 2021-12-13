<?php

namespace App\Repositories;

use App\Enums\GMBStatus;
use App\Enums\ProjectMemberType;
use App\Enums\ProjectStatus;
use App\Models\GmbSubmission;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Notifications\BusinessUpdated;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Project());
    }

    public function getProjects(array $search): LengthAwarePaginator
    {
        return Project::query()->active()->paginate($search['per_page'] ?? 15,
                ['id', 'title', 'overview', 'type', 'status', 'created_at', 'updated_at']);
    }

    public function submitBusiness(Project $project, array $data): GmbSubmission
    {
        return $project->businesses()->create(array_merge($data, [
                'status' => GMBStatus::pending()
        ]));
    }

    public function updateProject(Project $project, array $data): Project
    {
        if (!empty($data['status'])) {
            $data['status'] = ProjectStatus::fromValue($data['status']);
        }
        $project->update($data);
        $project->refresh();
        return $this->getProjectData($project);
    }

    public function getProjectData(Project $project): Project
    {
        return $project
                ->load(['excos', 'resources']);
    }

    public function addMember(Project $project, array $data): Model
    {
        if (empty($data['type'])) {
            $data['type'] = ProjectMemberType::Exco();
        }

        return $project->members()->create($data);
    }

    public function updateMember(ProjectMember $projectMember, array $data): ProjectMember
    {
        $projectMember->update($data);
        return $projectMember->refresh();
    }

    public function deleteMember(ProjectMember $projectMember): ?bool
    {
        return $projectMember->delete();
    }

    public function updateBusiness(GmbSubmission $business, array $data): GmbSubmission
    {
        $notify = isset($data['status']) && $data['status'] !== $business->status->key;

        $business->update($data);
        $business->refresh();

        if ($notify) {
            $business->corper->notify(new BusinessUpdated($business));
        }

        return $business;
    }

    public function getAllBusinesses(array $search): LengthAwarePaginator
    {
        return GmbSubmission::query()->search($search)->paginate($search['per_page'] ?? 15);
    }
}
