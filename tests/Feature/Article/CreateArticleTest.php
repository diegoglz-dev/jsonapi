<?php

namespace Tests\Feature\Article;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Article;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function can_create_articles()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nuevo artículo',
                    'slug'  =>  'nuevo-articulo',
                    'content' => 'Contenido del artículo'
                ]
            ]
        ]);
        
        $response->assertCreated(); // Verifica que recibimos el estado 201 que significa creado

        $article = Article::first();

        $response->assertHeader(
            'Location', 
            route('api.v1.articles.show', $article)
        );
        
        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => 'Nuevo artículo',
                    'slug'  =>  'nuevo-articulo',
                    'content' => 'Contenido del artículo'
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article)
                ]
            ]
        ]);
    }
}
