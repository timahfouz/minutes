<?php

namespace App\Http\Requests\Admin\Carriers;

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
            'username' => 'required|min:2|unique:carriers,username,'.$this->segment(3),
            'phone' => 'required|unique:carriers,phone,'.$this->segment(3),
            'password' => 'nullable|min:6|confirmed',
        ];
    }
}
