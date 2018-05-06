<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use App\Tag;

class ToolOnlyOnceInList implements Rule
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
        $array = array();
        foreach($value as $tag){ 
            if(!Tag::all()->pluck('slug')->contains($tag)){
                return false;
            }
            $collection = collect($array);
            if($collection->contains($tag)){
                return false;
            }  
            array_push($array, $tag);
        } 
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Je mag niet twee dezelfde tags hebben in de array of je moet een andere tag selecteren';
    }
}
