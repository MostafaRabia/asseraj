<?php

namespace App\Http\Requests;

use App\Traits\CrcemailTrait;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    use CrcemailTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email:strict,dns',
            'emailsig' => 'exists:users,emailsig',
            'password' => 'required|confirmed|min:8',
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
        ]);
    }
}
