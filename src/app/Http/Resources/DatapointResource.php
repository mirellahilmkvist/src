<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DatapointResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'text'           => $this->text,
            'is_direction'   => $this->is_direction,
            'point_pos_lat'  => $this->point_pos_lat,
            'point_pos_long' => $this->point_pos_long,
            'images'         => ImageResource::collection($this->images),
            'videos'         => VideoResource::collection($this->videos),
            'audio'          => AudioResource::collection($this->audio)
        ];
    }
}
