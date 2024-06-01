<?php

namespace User\Rules;

use Admin\Models\Broker;
use Admin\Models\Developer;
use Admin\Models\Individual;
use Illuminate\Contracts\Validation\Rule;

class CheckExistedEmail implements Rule
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
        if(
            Broker::where('email', $value)->first()
            || Individual::where('email', $value)->first()
            || Developer::where('email', $value)->first()
            )
            return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email has already been taken.';
    }
}
