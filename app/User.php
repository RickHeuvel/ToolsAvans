<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'nickname', 'firstName', 'lastName', 'location', 'role', 'provider', 'provider_id', 'admin'
    ];

    // Returns boolean provided by if statement
    public function isAdmin()
    {
        return boolval($this->admin);
    }

    // Returns boolean provided by if statement
    public function isEmployee()
    {
        return $this->isAdmin() ? false : ($this->role == "employee");
    }

    // Returns boolean provided by if statement
    public function isStudent()
    {
        return $this->isAdmin() ? false : ($this->role == "student");
    }

    public function getRole() {
        return $this->isAdmin() ? 'beheerder' : $this->role;
    }

    public static function admins() {
        return static::where('admin', true);
    }

    public static function empolyees() {
        return static::where('role', 'employee');
    }

    public static function students() {
        return static::where('role', 'student');
    }
}
