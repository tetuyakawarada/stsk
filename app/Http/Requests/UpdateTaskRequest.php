<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'event_id' => 'required',
            'subject_id' => 'required',
            'title' => 'required|string|max:50',
            'body' => 'nullable|string|max:2000',
            'total_page' => 'required|Integer',
            'page_time' => 'required|Integer',
        ];
    }
}
