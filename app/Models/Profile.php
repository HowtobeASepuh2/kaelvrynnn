<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'title', 'tagline', 'short_bio', 'long_bio',
        'photo', 'cv_file', 'email', 'phone',
        'instagram', 'github', 'linkedin', 'whatsapp',
    ];
}
