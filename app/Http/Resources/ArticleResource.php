<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'title' => $this->title,
            'body' => $this->body,
            'slug' => $this->slug,
            'subject' => $this->subject->name,
            'author' => $this->user->name,
            'published' => $this->created_at->diffForHumans(),
        ];
    }
}
