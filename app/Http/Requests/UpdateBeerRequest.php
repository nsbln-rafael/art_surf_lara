<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeerRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'sometimes|required|unique:beers|max:255',
            'description' => 'sometimes|required',
            'photo'       => 'image',
        ];
    }
}
