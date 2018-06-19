<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolTeacherReview extends Model
{
    protected $table = 'tool_teacher_reviews';
    protected $fillable = [
        'tool_slug', 'user_id', 'title', 'rating', 'description', 'preview', 'recommended'
    ];

    public function user()  {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function positives()  {
        return $this->hasMany('App\ToolReviewPositive', 'teacher_review_id');
    }

    public function negatives()  {
        return $this->hasMany('App\ToolReviewNegative', 'teacher_review_id');
    }
}
