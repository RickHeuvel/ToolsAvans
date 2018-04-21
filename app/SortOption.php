<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortOption extends Model
{
    protected $table = 'sortoptions';
    public $timestamps = false;
    public $active = false;
}
