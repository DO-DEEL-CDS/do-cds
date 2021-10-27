<?php

namespace App\Http\Controllers;

use App\Http\Requests\createArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $articles = $this->articleRepository->getArticles($request->all());

        return $this->success($articles);
    }


    public function store(createArticleRequest $request): JsonResponse
    {
        $article = $this->articleRepository->createArticle($request->all());
        return $this->success($article, 'News Created', 201);
    }

    public function show(Article $article): JsonResponse
    {
        return $this->success($this->articleRepository->getSingeArticle($article));
    }


    public function update(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        $article = $this->articleRepository->updateArticle($article, $request->validated());
        return $this->success($article, 'Article Updated', 200);
    }

    public function destroy(Article $article): JsonResponse
    {
        $this->articleRepository->deleteArticle($article);
        return $this->success();
    }
}
