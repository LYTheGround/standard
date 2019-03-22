<?php

namespace App\Http\Requests\Storage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'img.*'         => 'nullable|mimes:jpg,png,jpeg',
            'name'          => 'required|string|min:3|max:25',
            'description'   => 'nullable|string|min:10',
            'size'          => 'nullable|string|min:3',
            'tva'           => ['required', 'int', Rule::in(['0', '7', '10', '14', '20'])],
            'min_qt'        => 'required|int|min:1'
        ];
    }
}
