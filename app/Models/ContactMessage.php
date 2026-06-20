<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'category', 'message', 'is_read', 'is_archived'];

    protected $casts = [
        'is_read' => 'boolean',
        'is_archived' => 'boolean',
    ];
}
