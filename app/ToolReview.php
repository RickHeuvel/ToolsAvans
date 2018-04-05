<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolReview extends Model
{
    protected $fillable = [
        'tool_slug', 'user_id', 'title', 'rating', 'description'
    ];
}
