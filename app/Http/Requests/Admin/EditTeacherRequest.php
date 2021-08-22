<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditTeacherRequest extends FormRequest
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
        $arr = [
            'first_name' => ['required', 'min:2', 'max:30', 'regex:/^[^#%^&*\/()*\\\[\]\'\";|؟,~؛!<>?.=+@{}_$%\d]+$/u'],
            'last_name' => ['required', 'min:2', 'max:30', 'regex:/^[^#%^&*\/()*\\\[\]\'\";|؟,~؛!<>?.=+@{}_$%\d]+$/u'],
            'email' => 'required|email:strict,dns',
            'password' => 'nullable|min:8',
            'phone' => ['required', 'regex:/^[+]{0,1}[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/i'],
            'gender' => 'required|boolean',
            'age' => 'required|integer',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'section' => 'nullable|string',
            'reads_save' => 'nullable|array',
            'reads_save.*' => 'string',
            'reads_learning' => 'nullable|array',
            'reads_learning.*' => 'string',
            'price_of_minute' => 'nullable|integer|min:0',
            'from' => 'nullable',
            'to' => 'nullable',
            'vf_cash' => ['nullable', 'regex:/^[+]{0,1}[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/i'],
            'bank_account' => 'nullable',
            'name_of_bank' => 'nullable',
            'national_id' => 'nullable',
            'id_photo' => 'nullable|image',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
            'description' => 'required',
            'languages' => 'required|array',
            'languages.*' => 'string',
        ];

        if (optional($this->route('teacher'))->id != null){
            $arr['emailsig'] = 'unique:users,emailsig';
        }else{
            $arr['emailsig'] = 'unique:users,emailsig,'.optional($this->route('teacher'))->id;
        }

        return $arr;
    }
}
