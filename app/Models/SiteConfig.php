<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'section',
        'label',
        'order'
    ];

    /**
     * Get a config value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        $config = self::where('key', $key)->first();
        return $config ? $config->value : $default;
    }

    /**
     * Get all configs by group
     *
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getGroup(string $section)
    {
        return self::where('section', $section)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get all configs as key-value pairs
     *
     * @return array
     */
    public static function getAllAsArray()
    {
        return self::all()->pluck('value', 'key')->toArray();
    }
}
