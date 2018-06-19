<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolReviewNegative extends Model
{
    protected $table = 'review_negatives';
    public $timestamps = false;
    protected $fillable = [
        'teacher_review_id', 'title'
    ];
}
