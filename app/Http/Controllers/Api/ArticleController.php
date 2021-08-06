<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    public function show(Article $article): ArticleResource
    {
        return ArticleResource::make($article);
    }

    public function index(): ArticleCollection
    {
        // Necesitamos devolver una colección de ArticleResource
        // return ArticleResource::collection($articles);
        return ArticleCollection::make(Article::all()); // Necesitamos crearlo para poder enviar la llave links y otra llave data con la colección de articulos y se llama al metodo make
    }
}
