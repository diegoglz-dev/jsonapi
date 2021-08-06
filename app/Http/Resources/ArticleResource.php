<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            // 'data' => [ // El miembro 'data' es redundante porque los Laravel Resource los devuelven autoticamente en un array 'data'
                'type' => 'articles',
                'id' => (string) $this->resource->getRouteKey(),
                'attributes' => [
                    'title' => $this->resource->title,
                    'slug' => $this->resource->slug,
                    'content' => $this->resource->content
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $this->resource)
                ]
            // ]
        ];
    }
}
