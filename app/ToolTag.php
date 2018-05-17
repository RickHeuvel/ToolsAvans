<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class ToolTag extends Model
{
    use Sluggable;

    protected $primaryKey = 'slug';
    protected $table = 'tool_tag_lookup';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'pinned', 'category_slug'
    ];

    public function category() {
        return $this->hasOne('App\TagCategory', 'slug', 'category_slug');
    }

    public function tools() {
        return $this->belongsToMany('App\Tool', 'tool_tags', 'tag_slug', 'tool_slug');
    }

    // Query functions
    public static function usedTags() {
        return static::has('tools');
    }
}
