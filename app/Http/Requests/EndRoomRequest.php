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
        return $this->route('room')->teacher_id == auth()->user()->id || $this->route('room')->student_id == auth()->user()->id;
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
