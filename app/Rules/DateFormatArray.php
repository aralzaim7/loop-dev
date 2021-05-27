<?php

namespace App\Rules;

use Carbon\Carbon;
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
        if (Carbon::canBeCreatedFromFormat($explodedValue[0],'H:i') === false
            || Carbon::canBeCreatedFromFormat($explodedValue[1],'H:i') === false) {
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
        return
            'Selected slots need to have Hour:Minute format.';
    }
}
