<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
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
