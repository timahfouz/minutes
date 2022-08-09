<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'nullable|min:2',
            'price' => 'nullable|numeric|min:1',
            'discount' => 'nullable|numeric|min:0',
            'unit' => 'nullable|min:1',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }
}
