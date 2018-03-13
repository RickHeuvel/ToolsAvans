<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolStatus extends Model
{
    protected $table = 'tool_status';
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $timestamps = false;
}
