<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class ToolTag extends Model
{
    protected $table = 'tool_tags';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'tool_slug', 'tag_slug'
    ];

    public function tag() {
        return $this->belongsTo('App\Tag', 'tag_slug');
    }
}
