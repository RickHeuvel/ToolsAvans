<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use App\Specification;

class SpecificationDoesNotExist implements Rule
{
    private $specification;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($specification)
    {
        $this->specification = $specification;
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
        $newSlug = Str::slug($value);
        if ($this->specification->slug == $newSlug || ($this->specification->slug != $newSlug && !Specification::where('slug', $newSlug)->exists()))
            return true;
        
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Deze specificatienaam bestaat al.';
    }
}
