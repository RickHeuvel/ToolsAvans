<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MartinBean\Database\Eloquent\Sluggable;

class ToolCategory extends Model
{
    use Sluggable;

    protected $fillable = [
        'name', 'slug'
    ];

    protected $table = 'tool_category';
    public $timestamps = false;
}
