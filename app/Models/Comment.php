<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'email', 'body', 'reply', 'replied_at', 'is_approved', 'is_admin',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_admin'    => 'boolean',
        'replied_at'  => 'datetime',
    ];

    public function hasReply(): bool
    {
        return !is_null($this->reply);
    }
}