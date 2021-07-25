<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RegisterRequest;
use App\Traits\CrcemailTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    use CrcemailTrait;

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

        return [
            'emailsig' => 'unique:users,emailsig,'.auth()->user()->id,
            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'google' => 'nullable|string',
            'image' => 'nullable|image',
            'password' => 'nullable',
        ] + $rules->rules();
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
