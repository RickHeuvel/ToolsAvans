<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class ToolStatus extends Model
{
    use Sluggable;

    protected $primaryKey = 'slug';
    public $incrementing = false;
    protected $table = 'tool_status';
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];

    // Returns boolean provided by if statement
    public function isActive()
    {
        return ($this->slug == "actief");
    }

    // Returns boolean provided by if statement
    public function isConcept()
    {
        return ($this->slug == "concept");
    }

    // Returns boolean provided by if statement
    public function isInactive()
    {
        return ($this->slug == "inactief");
    }

    // Returns boolean provided by if statement
    public function isRejected()
    {
        return ($this->slug == "afgekeurd");
    }

    public function isOutdated()
    {
        return ($this->slug == "verouderd");
    }
}
