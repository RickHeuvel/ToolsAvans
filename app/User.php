<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'nickname', 'firstName', 'lastName', 'location', 'role', 'provider', 'provider_id',
    ];
}
