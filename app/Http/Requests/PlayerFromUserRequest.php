<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerFromUserRequest extends FormRequest
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
            'position'=>'required|exists:positions,id',
            'shirt_number'=>'required|integer|unique:players,shirt_number,NULL,id,team_id,1',
            'joined_at'=> 'required|date'
        ];
    }
}
