<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required|min:2',
            'price' => 'required|numeric|min:1',
            'discount' => 'nullable|numeric|min:0',
            'unit' => 'required|min:1',
            'in_stock' => 'numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
