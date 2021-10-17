<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository extends BaseRepository
{
    /**
     * Instantiate repository
     *
     * @param  Article  $model
     */
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    // Your methods for repository
}
