<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository extends BaseRepository
{
    /**
     * Instantiate repository
     *
     * @param  News  $model
     */
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    // Your methods for repository
}
