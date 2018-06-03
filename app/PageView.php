<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'page_views';

    protected $fillable = [
        'name'
    ];
}
