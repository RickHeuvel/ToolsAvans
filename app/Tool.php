<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class Tool extends Model
{
    use Sluggable;

    protected $primaryKey = 'slug';
    public $incrementing = false;

    protected $fillable = [
        'name', 'category_slug', 'status_slug', 'description', 'url', 'uploader_id', 'logo_filename'
    ];

    public function status() {
        return $this->belongsTo('App\ToolStatus', 'status_slug');
    }

    public function user()  {
        return $this->belongsTo('App\User', 'uploader_id');
    }

    public function images() {
        return $this->hasMany('App\ToolImage', 'tool_slug');
    }

    public function reviews() {
        return $this->hasMany('App\Review', 'tool_slug');
    }

    public function category() {
        return $this->belongsTo('App\ToolCategory', 'category_slug');
    }

    public function feedback() {
        return $this->hasOne('App\ToolFeedback', 'tool_slug');
    }

    // Query functions
    public static function activeTools() {
        return static::where('status_slug', 'actief');
    }

    public static function inactiveTools() {
        return static::where('status_slug', 'inactief');
    }

    public static function rejectedTools() {
        return static::where('status_slug', 'afgekeurd');
    }

    public static function unjudgedTools() {
        return static::where('status_slug', 'concept')->whereDoesntHave('feedback', function ($query) {
            $query->where('fixed', 0);
        });
    }

    public static function conceptTools() {
        return static::where('status_slug', 'concept');
    }

    public function views()
    {
        return $this->hasMany('App\ToolView', 'tool_slug', 'slug');
    }
}
