<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'icon_type',
        'icon_content',
        'stroke_color',
        'icon_color',
        'order',
    ];
} 