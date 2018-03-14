<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class ToolCategory extends Model
{
    use Sluggable;

    protected $primaryKey = 'slug';
    public $incrementing = false;
    protected $table = 'tool_category';
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];
}
