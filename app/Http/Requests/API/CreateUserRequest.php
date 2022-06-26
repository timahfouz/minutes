<?php

namespace App\Http\Requests\API;

use App\Http\Requests\ShapeRequest;

class CreateUserRequest extends ShapeRequest
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
            'name'  => 'required|min:2',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:8|confirmed',
            'governorate_id' => 'required|exists:places,id',
            'city_id' => 'required|exists:places,id',
            'area_id' => 'required|exists:places,id',
            'image' => 'nullable|image',
        ];
    }
}
