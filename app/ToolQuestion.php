<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolQuestion extends Model
{
    protected $fillable = [
        'tool_slug', 'user_id', 'title', 'text', 'best_answer_id'
    ];

    public function answers() {
        return $this->hasMany('App\ToolAnswer', 'question_id', 'id')->withCount('upvotes')->orderBy('upvotes_count', 'desc');
    }

    public function upvotes() {
        return $this->hasMany('App\ToolQuestionUpvote', 'question_id', 'id');
    }

    public function user()  {
        return $this->belongsTo('App\User', 'user_id');
    }
}
