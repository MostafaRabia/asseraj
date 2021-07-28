<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EndRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('room')->teacher_id == $this->user()->id || $this->route('room')->student_id == $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'teacher_report' => 'nullable|string',
            'teacher_rate' => 'nullable|integer|min:0',
            'student_rate' => 'nullable|integer|min:0',
        ];
    }
}
