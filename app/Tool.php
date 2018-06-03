<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use Sofa\Eloquence\Eloquence;

class Tool extends Model
{
    use Sluggable;
    use Eloquence;

    protected $primaryKey = 'slug';
    public $incrementing = false;

    protected $fillable = [
        'name', 'category_slug', 'status_slug', 'description', 'url', 'owner_id', 'logo_filename'
    ];

    public function status() {
        return $this->belongsTo('App\ToolStatus', 'status_slug');
    }

    public function user()  {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function images() {
        return $this->hasMany('App\ToolImage', 'tool_slug');
    }

    public function reviews() {
        return $this->hasMany('App\ToolReview', 'tool_slug');
    }

    public function category() {
        return $this->belongsTo('App\ToolCategory', 'category_slug');
    }

    public function tags()
    {
        return $this->belongsToMany('App\ToolTag', 'tool_tags', 'tool_slug', 'tag_slug');
    }

    public function feedback() {
        return $this->hasOne('App\ToolFeedback', 'tool_slug');
    }

    public function views()
    {
        return $this->hasMany('App\ToolView', 'tool_slug', 'slug');
    }

    public function questions(){
        return $this->hasMany('App\ToolQuestion', 'tool_slug', 'slug');
    }

    public function outdatedReport() {
        return $this->belongsTo('App\ToolOutdatedReport', 'slug', 'tool_slug');
    }

    public function questionAnswers() {
        return $this->hasManyThrough('App\ToolAnswer', 'App\ToolQuestion', 'tool_slug', 'question_id', 'slug', 'id');
    }

    // Query functions
    public static function publicTools() {
        return static::where(function ($query) {
            $query->where('status_slug', 'actief')->orWhere('status_slug', 'verouderd');
        });
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
}
