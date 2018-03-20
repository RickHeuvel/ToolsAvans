<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'name', 'email', 'nickname', 'firstName', 'lastName', 'location', 'role', 'provider', 'provider_id'
    ];

    // Returns boolean provided by if statement
    public function isAdmin()
    {
        return ($this->role == "admin");
    }

    // Returns boolean provided by if statement
    public function isEmployee()
    {
        return ($this->role == "employee");
    }

    // Returns boolean provided by if statement
    public function isStudent()
    {
        return ($this->role == "student");
    }
}
