<?php

namespace App\Models;

use App\Support\ImageUpload;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasSlug;

    protected $fillable = [
        'category_id', 'title', 'slug', 'description', 'objective',
        'project_status', 'role', 'duration', 'impact', 'tools', 'year',
        'thumbnail', 'og_image', 'demo_link', 'seo_title', 'seo_description', 'seo_keywords',
        'is_featured', 'is_published', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Project $project) {
            if ($project->thumbnail) {
                ImageUpload::delete($project->thumbnail);
            }

            if ($project->og_image) {
                ImageUpload::delete($project->og_image);
            }

            $project->images()->get()->each->delete();
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function metric()
    {
        return $this->hasOne(ProjectMetric::class);
    }
}
