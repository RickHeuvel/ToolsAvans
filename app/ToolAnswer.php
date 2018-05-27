<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolAnswer extends Model
{
    protected $fillable = [
        'question_id', 'user_id', 'text'
    ];

    public function upvotes(){
        return $this->hasMany('App\ToolAnswerUpvote', 'answer_id', 'id');
    }

    public function question() {
        return $this->hasOne('App\ToolQuestion', 'id', 'question_id');
    }

    public function user()  {
        return $this->belongsTo('App\User', 'user_id');
    }
}
