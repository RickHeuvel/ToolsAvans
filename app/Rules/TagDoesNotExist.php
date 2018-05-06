<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use App\Tag;

class TagDoesNotExist implements Rule
{
    private $tag;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
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
        if ($this->tag->slug == $newSlug || ($this->tag->slug != $newSlug && !Tag::where('slug', $newSlug)->exists()))
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
        return 'Deze tagnaam bestaat al.';
    }
}
