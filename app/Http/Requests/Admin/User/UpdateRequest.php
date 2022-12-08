<?php

namespace App\Http\Requests\Admin\User;

use App\Enum\UserEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$this->user->id},id",
            'mobile' => "required|unique:users,mobile,{$this->user->id},id",
            'password' => 'nullable|min:6',
            'user_role' => 'required|in:' . implode(",", UserEnum::getRoles())
        ];
    }
}
