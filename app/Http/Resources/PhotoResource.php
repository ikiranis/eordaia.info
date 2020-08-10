<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
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
            'path' => $this->path,
            'filename' => $this->filename,
            'description' => $this->description,
            'referral' => $this->referral,
            'photoUrl' => $this->photoUrl,
            'smallPhotoUrl' => $this->smallPhotoUrl,
            'mediumPhotoUrl' => $this->mediumPhotoUrl,
        ];
    }
}
