<?php

namespace App\Http\Requests\Money;

use App\Rules\UnloadRules;
use Illuminate\Foundation\Http\FormRequest;

class UnloadRequest extends FormRequest
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
        if($this->unload){
            return [
                'justify'       => 'nullable|mimes:jpg,jpeg,png',
                'prince'        => 'required|numeric|min:1',
                'date'          => 'required|date',
                'description'   => 'nullable|string|max:1000',
                'on'            => ['required', new UnloadRules()]
            ];
        }
        else{
            return [
                'justify'       => 'required|mimes:jpg,jpeg,png',
                'prince'        => 'required|int|min:1',
                'date'          => 'required|date',
                'description'   => 'nullable|string',
                'on'            => ['required', new UnloadRules()]
            ];
        }

    }
}
