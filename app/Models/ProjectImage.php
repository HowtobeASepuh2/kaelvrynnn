<?php

namespace App\Models;

use App\Support\ImageUpload;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'image', 'caption', 'sort_order'];

    protected static function booted(): void
    {
        static::deleting(function (ProjectImage $image) {
            if ($image->image) {
                ImageUpload::delete($image->image);
            }
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
