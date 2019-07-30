<?php

namespace App\Http\Requests;

use App\Rules\UniqueShirtNumber;
use Illuminate\Foundation\Http\FormRequest;

class EditPlayerRequest extends FormRequest
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
            'position'=>'required|exists:positions,id',
            'team' => 'required|exists:teams,id',
            'shirt_number' => ['required', 'integer', new UniqueShirtNumber($this->route()->player->id, $team_id)],
            'joined_at'=> 'required|date'
        ];
    }
}
