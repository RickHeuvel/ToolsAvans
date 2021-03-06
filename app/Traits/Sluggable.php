<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Original creator: Martin Bean
 * Licensed under: MIT
 */
trait Sluggable
{
    /**
     * Boot the sluggable trait for a model.
     *
     * @return void
     */
    public static function bootSluggable()
    {
        static::saving(function (Model $model) {
            $model->setSlug(Str::slug($model->getSluggableString()));
        });
    }

    /**
     * The name of the column to use for slugs.
     *
     * @return string
     */
    public function getSlugColumnName()
    {
        return 'slug';
    }

    /**
     * Set the slug to the given value.
     *
     * @param  string  $value
     * @return $this
     */
    public function setSlug($value)
    {
        $this->setAttribute($this->getSlugColumnName(), $value);

        return $this;
    }

    /**
     * Get the string to create a slug from.
     *
     * @return string
     */
    public function getSluggableString()
    {
        return $this->getAttribute('name');
    }
}