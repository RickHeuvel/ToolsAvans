<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolFeedback extends Model
{
    protected $primaryKey = 'tool_slug';
    protected $table = 'tool_feedback';

    protected $fillable = [
        'tool_slug', 'feedback',
    ];
}
