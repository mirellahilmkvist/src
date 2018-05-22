<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoundRequest extends FormRequest
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
            'title'          => 'required',
            'author'         => 'required',
            'description'    => 'required',
            'genre'          => 'required',
            'image'          => 'required_without:image_id',  // TODO Will not work without new image, or already existing image. Good maybe?
            'image_id'       => 'required_without:image',
            'city'           => 'required',
            'start_pos_lat'  => 'required',
            'start_pos_long' => 'required'
        ];
    }
}