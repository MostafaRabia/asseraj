<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PayWithVCRequest extends FormRequest
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
            'plan_id' => 'required|exists:plans,id',
            'type' => 'required|in:vf cash',
            'price' => 'required',
            'minutes' => 'required',
            'photo' => 'required|image',
            'phone' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'invoice_id' => Str::random(10),
            'user_id' => $this->user()->id,
        ]);
    }
}
