<?php

namespace App\Http\Requests;

use App\Traits\CrcemailTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterTeacherRequest extends FormRequest
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
            'first_name' => ['required', 'min:2', 'max:30', 'regex:/^[^#%^&*\/()*\\\[\]\'\";|؟,~؛!<>?.=+@{}_$%\d]+$/u'],
            'last_name' => ['required', 'min:2', 'max:30', 'regex:/^[^#%^&*\/()*\\\[\]\'\";|؟,~؛!<>?.=+@{}_$%\d]+$/u'],
            'email' => 'required|email:strict,dns',
            'emailsig' => 'unique:users,emailsig',
            'password' => 'required|min:8',
            'phone' => ['required', 'regex:/^[+]{0,1}[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/i'],
            'gender' => 'required|boolean',
            'age' => 'required|integer',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'section' => 'nullable|string',
            'reads_save' => 'nullable|array',
            'reads_save.*' => 'string',
            'information' => 'nullable|string|min:10',
            'timezone' => 'required|timezone',
        ];
    }

    // public function attributes()
    // {
    //     return [
    //         'emailsig' => 'email',
    //     ];
    // }

    protected function prepareForValidation()
    {
        $this->merge([
            'emailsig' => $this->crcemail($this->email)[1],
            'information' => links_newlines_text($this->information),
        ]);
    }
}
