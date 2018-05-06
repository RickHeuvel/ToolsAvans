<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class Tag extends Model
{
    use Sluggable;

    protected $primaryKey = 'slug';
    protected $table = 'tool_tag_lookup';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'default',
    ];
}
