<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Storage;

class ImageExistsOnDisk implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        return Storage::disk('tool-images')->exists($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Dit plaatje bestaat niet op de server';
    }
}
