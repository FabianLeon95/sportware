<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->user == \Auth::user()){
            return true;
        } else{
            return false;
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:users,email,".$this->route()->user->id,
            "birthdate" => "required|date",
            "nationality" => "required",
            "marital_status" => "required|exists:marital_statuses,id",
            "phone_number" => "required|numeric",
        ];
    }
}
