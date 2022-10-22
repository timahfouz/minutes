<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SpecialOrderRequest extends FormRequest
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
            'coupon' => 'nullable|exists:coupons,code',
            'name' => 'required|min:2',
            'phone' => 'required',
            'address' => 'required|min:10',
            'description' => 'required|min:5',
            'image' => 'nullable|image',
        ];
    }
}
