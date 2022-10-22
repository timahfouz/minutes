<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'website' => 'required',
            'commission' => 'required|numeric|min:0',
            'delivery_fees' => 'required|numeric|min:0',
            'about_us' => 'required',
        ];
    }
}
