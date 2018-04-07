<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolView extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tool_views';
    public $timestamps = false;

    protected $fillable = [
        'tool_slug', 'created_at'
    ];

    public function Tool()
    {
        return $this->belongsTo('App\Tool', 'tool_slug');
    }
}
