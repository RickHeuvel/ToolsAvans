<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = ['tool_slug', 'user_id'];

    protected $fillable = [
        'tool_slug', 'user_id', 'title', 'rating', 'description'
    ];

    
}
