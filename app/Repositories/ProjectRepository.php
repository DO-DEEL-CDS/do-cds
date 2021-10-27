<?php

namespace App\Repositories;

use App\Enums\GMBStatus;
use App\Models\GmbSubmission;
use App\Models\Project;

class ProjectRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Project());
    }

    public function getProjects()
    {
        return Project::query()->active()->simplePaginate(15, ['id', 'title', 'type', 'status', 'created_at', 'updated_at']);
    }

    public function getProjectData(Project $project)
    {
        return $project
            ->load(['excos', 'resources']);
    }

    public function submitBusiness(Project $project, array $data): GmbSubmission
    {
        return $project->businesses()->create(array_merge($data, [
            'status' => GMBStatus::pending()
        ]));
    }
}
