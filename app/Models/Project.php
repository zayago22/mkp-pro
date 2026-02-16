<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use Translatable;

    protected $fillable = [
        'title', 'slug', 'image', 'category',
        'short_description', 'description', 'order', 'is_active',
        'title_en', 'title_es',
        'short_description_en', 'short_description_es',
        'description_en', 'description_es',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800';
        }

        return str_starts_with($this->image, 'projects')
            ? asset('storage/' . $this->image)
            : asset($this->image);
    }

    public function sliderImages(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
}
