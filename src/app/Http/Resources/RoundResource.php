<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
//        $startDatapointId = null;
//        if ($this->start_datapoint_id != null) {
//            $startDatapointId = $this->start_datapoint_id;
//        }
        return [
            'id'                 => $this->id,
            'user_id'            => $this->user_id,
            'author'             => $this->author,
            'genre'              => $this->genre,
            'title'              => $this->title,
            'description'        => $this->description,
            'city'               => $this->city,
            'start_pos_lat'      => $this->start_pos_lat,
            'start_pos_long'     => $this->start_pos_long,
            'start_datapoint_id' => $this->start_datapoint_id,
            'language'           => $this->language,
            'finished'           => $this->finished,
            'published'          => $this->published,
            'image'              => $this->image
        ];
    }
}
