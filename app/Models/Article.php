<?php

namespace App\Models;

use App\Support\ImageUpload;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasSlug;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'cover_image', 'seo_title', 'seo_description', 'is_published', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Article $article) {
            if ($article->cover_image) {
                ImageUpload::delete($article->cover_image);
            }
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
