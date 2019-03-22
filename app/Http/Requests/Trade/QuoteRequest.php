<?php

namespace App\Http\Requests\Trade;

use App\Rules\DealExistRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuoteRequest extends FormRequest
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
            'deal'      => ['required','int', new DealExistRule()],
            'pu.*'     => 'required|numeric|min:0.1'
        ];
    }
}
