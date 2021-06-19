<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = new RegisterRequest();

        return $rules->rules() + [
            'emailsig' => 'unique:users,emailsig,'.auth()->user()->id,
            'facebook' => 'string',
            'twitter' => 'string',
            'google' => 'string',
            'image' => 'image',
        ];
    }

    public function attributes()
    {
        return [
            'emailsig' => 'email',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'emailsig' => $this->crcemail($this->email)[1],
            'information' => links_newlines_text($this->information),
        ]);
    }
}
