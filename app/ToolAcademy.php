<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class ToolAcademy extends Model
{
    use Sluggable;

    protected $primaryKey = 'slug';
    protected $table = 'academy_lookup';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'slug', 'name'
    ];
}
