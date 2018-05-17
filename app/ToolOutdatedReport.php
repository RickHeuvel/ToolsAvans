<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolOutdatedReport extends Model
{
    protected $table = 'tool_outdated_reports';
    protected $primaryKey = 'tool_slug';
    public $incrementing = false;

    protected $fillable = ['tool_slug', 'user_id', 'feedback'];

    public function tool() {
        return $this->hasOne('App\Tool', 'slug', 'tool_slug');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
