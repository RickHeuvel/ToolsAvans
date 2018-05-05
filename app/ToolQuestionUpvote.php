<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolQuestionUpvote extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'question_id', 'user_id', 'created_at'
    ];
}
