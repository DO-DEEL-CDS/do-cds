<?php

namespace App\Repositories;

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
}
