<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMetric extends Model
{
    protected $fillable = ['project_id', 'views', 'demo_clicks', 'share_clicks'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
