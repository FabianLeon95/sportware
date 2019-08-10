<?php

namespace App\Http\Requests;

use App\Rules\VerifyPassword;
use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
            "old_password" => ['required', new VerifyPassword()],
            "password" => 'required|confirmed',
            "password_confirmation" => 'required'
        ];
    }
}
