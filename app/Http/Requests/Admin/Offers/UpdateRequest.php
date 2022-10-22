<?php

namespace App\Http\Requests\Admin\Offers;

use App\Rules\TodayTimeValidation;
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
            'product_id' => 'required|exists:products,id',
            'new_price' => 'required|numeric',
            'new_unit' => 'required',
            'is_offer_expired' => 'required|in:0,1',
            'expired_at' => ['required_if:is_offer_expired,==,1', new TodayTimeValidation],
        ];
    }
}
