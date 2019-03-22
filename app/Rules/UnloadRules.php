<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UnloadRules implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value === 'tva' || $value === 'is';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.regex',['on' => __('validation.attributes.onUnload')]);
    }
}
