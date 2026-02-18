<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'meta',
        'hero_title',
        'hero_subtitle',
        'hero_theme',
        'hero_background',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public static function getByKey(string $key)
    {
        return static::where('key', $key)->first();
    }
}
