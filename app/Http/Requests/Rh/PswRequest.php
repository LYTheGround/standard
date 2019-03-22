<?php

namespace App\Http\Requests\Rh;

use App\Rules\OldPasswordRule;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class PswRequest extends FormRequest
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
            'old_password'  => ['bail', 'required', 'string','min:6', 'max:18',new PasswordRule(), new OldPasswordRule()],
            'password'      => ['bail','required','string','min:6','max:18','confirmed',new PasswordRule()],
        ];
    }
}
