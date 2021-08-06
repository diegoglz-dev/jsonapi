<?php

namespace Tests\Feature\Article;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Article;

class ListArticlesTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function can_fetch_a_single_article()
    {
        // Deshabilito manejo de excepciones para que muestre errores más concretos.
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        $response = $this->getJson(route('api.v1.articles.show', $article)); // getRouteKey() devuelve el id del articulo.
        // agragando ->dump() al final del metodo podemos ver la respuesta en la terminal

        // $response->assertSee($article->title); // Visualiza el titulo del articulo
        // De esta forma solo mostraría un Json pero queremos que lo muestre de acuerdo a una especificación.

        // con assertJson no se verifican tipos de datos pero con assertExactJson si
        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'content' => $article->content
                ],
                'links' => [
                    // 'self' => url('/api/v1/articles/'. $article->getRouteKey()) // la base del dominio va a ser la que tenemos definida en el archivo .env (APP_URL)
                    'self' => route('api.v1.articles.show', $article)
                ]
            ]
        ]);
    }
}
