<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\Paginator;

class ArticleRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Article());
    }

    public function getArticles(array $search): Paginator
    {
        return Article::query()
            ->search($search)
            ->published()
            ->latest()
            ->simplePaginate();
    }

    public function getSingeArticle(Article $article)
    {
        return $article;
    }
}
