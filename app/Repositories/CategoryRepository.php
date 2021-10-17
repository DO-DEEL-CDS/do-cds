<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    /**
     * Instantiate repository
     */
    public function __construct()
    {
        parent::__construct(new Category());
    }

    public function all()
    {
        return Category::get(['id', 'title']);
    }


}
