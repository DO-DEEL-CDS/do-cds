<?php

namespace App\Repositories;

use App\Enums\ArticleStatus;
use App\Extensions\Utils\UploadManager;
use App\Models\Article;
use App\Models\Roles\Corper;
use App\Notifications\NewsPublished;
use Illuminate\Contracts\Pagination\Paginator;

class ArticleRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Article());
    }

    public function getArticles(array $search): Paginator
    {
        $q = Article::query();

        if (auth()->check() && auth()->user()->hasRole('corper')) {
            $q->where('state_code', auth()->user()->profile->state_code)
                    ->orWhereNull('state_code');
        }

        return $q->search($search)
                ->published()
                ->with('author')
                ->latest()
                ->paginate($search['per_page'] ?? 15);
    }

    public function createArticle(array $data): Article
    {
        $data['status'] = ArticleStatus::Published();
        $article = request()->user()->articles()->create($data);

        Corper::notifyAll(new NewsPublished($article));
        return $this->getSingeArticle($article);
    }

    public function getSingeArticle(Article $article): Article
    {
        return $article->load(['author']);
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
