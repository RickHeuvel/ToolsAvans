<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class ToolSpecification extends Model
{
    public $primaryKey = ['tool_slug', 'specification_slug'];
    protected $table = 'tool_specifications';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'tool_slug', 'specification_slug', 'value',
    ];

    public function specification() {
        return $this->belongsTo('App\Specification', 'specification_slug');
    }
}
