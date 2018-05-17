<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use App\TagCategory;

class TagCategoryDoesNotExist implements Rule
{
    private $tagCategory;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tagCategory)
    {
        $this->tagCategory = $tagCategory;
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
        if ($this->tagCategory->slug == $newSlug || ($this->tagCategory->slug != $newSlug && !TagCategory::where('slug', $newSlug)->exists()))
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
        return 'Deze tag categorie naam bestaat al.';
    }
}
