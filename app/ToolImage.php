<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolImage extends Model
{
    protected $table = 'tool_images';
    protected $primaryKey = 'image_filename';
    public $incrementing = false;

    protected $fillable = ['tool_slug', 'image_filename'];

    public function tool() {
        return $this->hasOne('App\Tool');
    }
}
