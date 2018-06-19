<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolReviewPositive extends Model
{
    protected $table = 'review_positives';
    public $timestamps = false;
    protected $fillable = [
        'teacher_review_id', 'title'
    ];
}
