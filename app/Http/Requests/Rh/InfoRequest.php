<?php

namespace App\Http\Requests\Rh;

use App\Rules\PhoneRule;
use App\Rules\SexRule;
use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
            'face'          => 'nullable|mimes:jpeg,bmp,jpeg,png',
            'name'          => 'bail|required|string|max:25|unique:members,id,' . auth()->user()->member->id,
            'email'         => 'required|string|email|max:80|unique:emails,info_id,' . auth()->user()->member->info->id,
            'phone'         => ['bail','required','min:10','max:10',new PhoneRule()],
            'first_name'    => 'required|string|min:2|max:20',
            'last_name'     => 'required|string|min:2|max:20',
            'sex'           => ['nullable', new SexRule()],
            'birth'         => ['bail','nullable','date', 'before:' . date('d-m-Y',strtotime("-18 years"))],
            'address'       => 'nullable|string|min:10|max:100',
            'city'          => 'bail|required|exists:cities,id',
            'cin'           => 'nullable|string|max:20',
        ];
    }
}
