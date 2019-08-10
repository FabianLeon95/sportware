<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventCategoryRequest extends FormRequest
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
            'category_name'=>'required|max:255',
            'description'=>'max:255',
            'color'=>'required|regex:/#([a-fA-F0-9]{3}){1,2}\b/'
        ];
    }
}
