<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolAnswerUpvote extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'answer_id', 'user_id', 'created_at'
    ];
}
