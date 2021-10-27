<?php

namespace App\Services;

use App\Enums\ProjectType;
use App\Models\GmbSubmission;
use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectService extends BaseService
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @param  ProjectRepository  $repository
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createGmbSubmission(Project $project, array $data): GmbSubmission
    {
        abort_if(!$project->type->is(ProjectType::gmb()), 400, 'Only allowed for Project of type: ' . ProjectType::gmb()->description);
        return $this->repository->submitBusiness($project, $data);
    }
}
