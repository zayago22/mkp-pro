<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use Translatable;

    protected $fillable = [
        'quote', 'author_name', 'author_title',
        'rating', 'order', 'is_active',
        'quote_en', 'quote_es',
        'author_title_en', 'author_title_es',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
