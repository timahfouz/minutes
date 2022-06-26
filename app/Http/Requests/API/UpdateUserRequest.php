<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'  => 'nullable|min:2',
            'phone' => 'nullable|unique:users,phone,'.getUser()->id,
            'password' => 'nullable|min:8|confirmed',
            'governorate_id' => 'nullable|exists:places,id',
            'city_id' => 'nullable|exists:places,id',
            'area_id' => 'nullable|exists:places,id',
            'image' => 'nullable|image',
        ];
    }
}
