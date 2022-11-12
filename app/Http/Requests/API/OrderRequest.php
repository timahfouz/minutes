<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'items'  => 'required|array',
            'coupon' => 'nullable|exists:coupons,code',
            'name' => 'required|min:2',
            'phone' => 'required',
            'address' => 'required|min:10',
            'extra_address' => 'required|min:10',
        ];

        if (request()->filled('items') && is_array(request()->items)) {
            foreach (request()->items as $key => $value) {
                $rules["items.$key.product_id"] = "nullable|exists:products,id";
                $rules["items.$key.offer_id"] = "nullable|exists:offers,id";
                $rules["items.$key.qty"] = "required|numeric|min:1";
            }
        }
        
        return $rules;
    }
}
