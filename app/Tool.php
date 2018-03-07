<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MartinBean\Database\Eloquent\Sluggable;

class Tool extends Model
{
    use Sluggable;

    protected $fillable = [
        'name', 'slug', 'category_id', 'status', 'description', 'URL', 'uploader_id'
    ];

    public function Status() {
        return $this->hasOne('App\ToolStatus');
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'uploader_id');
    }

    public function Category()
    {
        return $this->belongsTo('App\ToolCategory', 'category_id');
    }
}
