<?php

namespace App\Rules;

use App\Deal;
use Illuminate\Contracts\Validation\Rule;

class DealExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Deal::where([['id' , $value],['company_id',auth()->user()->member->company_id]])->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le choix de deal est erroné';
    }
}
