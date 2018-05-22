<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDatapointRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'is_direction'   => 'required',
            'title'          => 'required',
            'text'           => 'required',
            // TODO This may not be needed
//            'image'          => 'required_without:image_id', // TODO Will not work without new image, or already existing image. Good maybe?
//            'image_id'       => 'required_without:image',
//            'audio'          => 'required_without:audio_id',
//            'audio_id'       => 'required_without:audio',
//            'video'          => 'required_without:video_id',
//            'video_id'       => 'required_without:video',
            'point_pos_lat'  => 'required',
            'point_pos_long' => 'required',
//            'hasNext' => 'required' // TODO Maybe better to do default value false? --> Default value is now false.
        ];
    }
}