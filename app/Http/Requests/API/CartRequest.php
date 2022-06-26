<?php

namespace App\Http\Requests\API;

use App\Http\Requests\ShapeRequest;

class CartRequest extends ShapeRequest
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
        $rules = [
            'items'  => 'required|array'
        ];

        if (request()->filled('items') && is_array(request()->items)) {
            foreach (request()->items as $key => $value) {
                $rules["items.$key.product_id"] = "required|exists:products,id";
                $rules["items.$key.qty"] = "required|numeric|min:1";
            }
        }
        return $rules;
    }
}
