<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

use Illuminate\Http\Request;

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

    public function create(Request $request)
    {
        // dd($request->all());
        // dd($request->input('data.attributes'));
        // Article::create($request->input('data.attributes'));
        /**
         * Esto se podria hacer si tuvieramos habilitada la asignación masiva
         * Pero tenemos la propiedad $guarded = [] en el modelo  
         * */
        // Entonces se hace manualmente uno por uno
        $article = Article::create([
            'title' => $request->input('data.attributes.title'),
            'slug' => $request->input('data.attributes.slug'),
            'content' => $request->input('data.attributes.content'),
        ]);
        return ArticleResource::make($article);
    } 
}
