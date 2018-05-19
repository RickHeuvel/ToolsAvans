<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name', 'val'
    ];

    /**
     * Get a settings value
     *
     * @param $key
     * @param null $default
     * @return bool|int|mixed
     */
    public static function get($key, $default = null)
    {
        if ( self::has($key) ) {
            $setting = self::All()->where('name', $key)->first();
            return $setting;
        }

        return $default;
    }

    /**
     * Check if setting exists
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return (boolean) self::All()->whereStrict('name', $key)->count();
    }
}
