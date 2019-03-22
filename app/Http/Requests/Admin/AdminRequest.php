<?php

namespace App\Http\Requests\Admin;

use App\Rules\PasswordRule;
use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $this->city_id = $this->city;
        if (request()->is('admin/create')) {
            return [
                'login' => 'bail|required|string|min:3|max:191|unique:users,login',
                'tel' => ['bail', 'required', 'string', 'min:10', 'max:10', 'unique:admins,tel', new PhoneRule()],
                'email' => ['bail', 'required', 'string', 'email', 'unique:users,email'],
                'city' => ['bail', 'required', 'int', 'exists:cities,id'],
                'password' => ['required', 'string', 'min:6', 'max:20', 'confirmed', new PasswordRule()]
            ];
        }
        return [
            'login' => 'bail|required|string|min:3|max:191|unique:users,login,' . auth()->id(),
            'tel' => ['bail', 'required', 'string', 'min:10', 'max:10', 'unique:admins,tel,' . auth()->user()->admin->id, new PhoneRule()],
            'email' => ['bail', 'required', 'string', 'email', 'unique:users,email,' . auth()->id()],
            'city' => ['bail', 'required', 'int', 'exists:cities,id'],
            'password' => ['nullable', 'string', 'min:6', 'max:20', 'confirmed', new PasswordRule()]
        ];
    }
}
