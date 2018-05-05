<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Tool extends Model
{
    use Sluggable;
    use SearchableTrait;

    protected $primaryKey = 'slug';
    public $incrementing = false;

    protected $fillable = [
        'name', 'category_slug', 'status_slug', 'description', 'url', 'uploader_id', 'logo_filename'
    ];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         *
         * status is not searchable because the status of a tool is only used internally at ToolHub
         * specifications are not searchable because these would be too broad and vague
         *  because you would have to search in the key and value
         * @var array
         */
        'columns' => [
            'tools.name'            => 10,
            'tools.slug'            => 9,
            'tools.description'     => 3,
            'tools.url'             => 5,
            'tools.category_slug'   => 7,
            'tool_category.name'    => 8,
            'users.nickname'        => 4,
        ],
        'joins' => [
            'tool_category'  => ['tools.category_slug', 'tool_category.slug'],
            'users'   => ['tools.uploader_id', 'users.id'],
        ],
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
        return $this->hasMany('App\ToolReview', 'tool_slug');
    }

    public function category() {
        return $this->belongsTo('App\ToolCategory', 'category_slug');
    }

    public function specifications()
    {
        return $this->hasMany('App\ToolSpecification', 'tool_slug');
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
}
