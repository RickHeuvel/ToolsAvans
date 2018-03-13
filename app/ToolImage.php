<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolImage extends Model
{
    protected $table = 'tool_images';
    protected $primaryKey = ['tool_slug', 'image_filename'];
    public $incrementing = false;

    protected $fillable = ['tool_slug', 'image_filename'];
}
