<?php

namespace App\Repositories;

use App\Models\Employment;
use Illuminate\Contracts\Pagination\Paginator;

class EmploymentRepository extends BaseRepository
{
    /**
     * Instantiate repository
     *
     * @param  Employment  $model
     */
    public function __construct(Employment $model)
    {
        parent::__construct($model);
    }

    public function getLatestJobs(array $search): Paginator
    {
        return Employment::latest()
            ->search($search)
            ->open()
            ->simplePaginate();
    }
}
