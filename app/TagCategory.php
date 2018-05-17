<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class TagCategory extends Model
{
    use Sluggable;

    protected $primaryKey = 'slug';
    protected $table = 'tag_category';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];

    public function toolTags() {
        return $this->hasMany('App\ToolTag', 'category_slug', 'slug');
    }
}
