<?php

namespace App\Repositories;

use App\Enums\ArticleStatus;
use App\Extensions\Utils\UploadManager;
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
            ->with('author')
            ->latest()
            ->paginate($search['per_page'] ?? 15);
    }

    public function getSingeArticle(Article $article): Article
    {
        return $article->load(['author']);
    }

    public function createArticle(array $data): Article
    {
        $data['status'] = ArticleStatus::Published();
        $article = request()->user()->articles()->create($data);
        return $this->getSingeArticle($article);
    }

    public function updateArticle(Article $article, array $data): Article
    {
        $article->update($data);
        $article->refresh();
        return $this->getSingeArticle($article);
    }

    public function deleteArticle(Article $article): bool
    {
        UploadManager::init()->deleteFile($article->image);
        return Article::where('id', $article->id)->delete();
    }
}
