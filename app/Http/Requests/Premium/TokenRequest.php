<?php

namespace App\Http\Requests\Premium;

use Illuminate\Foundation\Http\FormRequest;

class TokenRequest extends FormRequest
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
        $this->company = auth()->user()->member->company;
        return [
            'category'  => ['required','int','in:3,4,5,6,7'],
            'range'     => 'required|int|min:1|lte:' . $this->company->premium->sold
        ];
    }
}
