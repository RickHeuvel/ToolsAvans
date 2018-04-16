<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use App\Tool;

class ToolDoesNotExist implements Rule
{
    private $tool;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tool)
    {
        $this->tool = $tool;
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
        if ($this->tool->slug == $newSlug || ($this->tool->slug != $newSlug && !Tool::where('slug', $newSlug)->exists()))
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
        return 'Deze toolnaam bestaat al.';
    }
}
