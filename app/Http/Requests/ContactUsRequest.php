<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => 'required|max:30',
            'email' => 'required|email:dns',
            'phone' => ['required', 'regex:/^[+]{0,1}[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/i','max:30'],
            'subject' => 'required|max:30',
            'message' => 'required',
        ];
    }
}
