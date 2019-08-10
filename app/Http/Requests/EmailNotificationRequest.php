<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailNotificationRequest extends FormRequest
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
            "recipients" => "array|min:1|required",
            "subject" => "required",
            "message" => "required"
        ];
    }
}
