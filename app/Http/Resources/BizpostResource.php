<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BizpostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'body' => $this->body,
            'kind' => $this->kind,
            'due_date' => $this->due_date
        ];
    }
}
