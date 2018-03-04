<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MartinBean\Database\Eloquent\Sluggable;

class Tool extends Model
{
    use Sluggable;

    protected $fillable = [
        'name', 'category', 'status', 'description', 'URL', 'uploader_id'
    ];

    public function Category() {
        return $this->hasOne('App\ToolCategory');
    }

    public function Status() {
        return $this->hasOne('App\ToolStatus');
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'uploader_id');
    }
}
