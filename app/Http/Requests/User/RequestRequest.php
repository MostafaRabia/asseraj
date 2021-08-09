<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class RequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !DB::table('requests')->where('user_id', auth()->user()->id)->exists() && !DB::table('rooms')->where('student_id', auth()->user()->id)->where('status', 'open')->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:save,check,learn',
            'info' => 'nullable|string|min:2',
            'read' => 'required_if:type,learn',
            'teacher_id' => 'nullable|exists:users,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'info' => links_newlines_text($this->info),
        ]);
    }
}
