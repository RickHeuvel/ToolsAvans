<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MartinBean\Database\Eloquent\Sluggable;

class Tool extends Model
{
    use Sluggable;

    protected $primaryKey = 'slug';
    public $incrementing = false;

    protected $fillable = [
        'name', 'category_slug', 'status', 'description', 'url', 'uploader_id', 'logo_filename'
    ];

    public function Status() {
        return $this->hasOne('App\ToolStatus');
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'uploader_id');
    }

    public function Images()
    {
        return $this->hasMany('App\ToolImage', 'tool_slug');
    }

    public function Category()
    {
        return $this->belongsTo('App\ToolCategory', 'category_slug');
    }
}
