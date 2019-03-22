<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SexRule implements Rule
{

    public function passes($attribute, $value)
    {
        return ($value == 'homme' || $value == 'femme');
    }

    public function message()
    {
        return __('validation.regex',[__('validation.attributes.sex')]);
    }
}
