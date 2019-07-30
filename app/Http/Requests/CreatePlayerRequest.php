<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlayerRequest extends FormRequest
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
        $team_id = $this->get('team');
        return [
            'name'=> 'required',
            'email'=>'required|email|unique:users',
            'position'=>'required|exists:positions,id',
            'team' => 'required|exists:teams,id',
            'shirt_number'=>'required|integer|unique:players,shirt_number,NULL,id,team_id,'.$team_id,
            'joined_at'=> 'required|date'
        ];
    }
}
