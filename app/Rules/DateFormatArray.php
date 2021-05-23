<?php

namespace App\Rules;

use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Validation\Rule;

class DateFormatArray implements Rule
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
    public function passes($attribute, $value): bool
    {
        $explodedValue = explode(' - ', $value);
        if (DateTime::createFromFormat('H:i', $explodedValue[0]) === false
            || DateTime::createFromFormat('H:i', $explodedValue[0]) === false) {
            return false;
        }
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Selected slots need to have Hour:Minute format.';
    }
}
