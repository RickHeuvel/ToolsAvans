<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolReview extends Model
{
    protected $fillable = [
        'tool_slug', 'user_id', 'title', 'rating', 'description'
    ];

    public function user()  {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function tool() {
        return $this->belongsTo('App\Tool', 'tool_slug');
    }
}
