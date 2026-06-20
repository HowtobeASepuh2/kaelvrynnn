<?php

namespace App\Models;

use App\Support\ImageUpload;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'email', 'avatar', 'body', 'reply', 'replied_at', 'is_approved', 'is_admin', 'is_pinned',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_admin' => 'boolean',
        'is_pinned' => 'boolean',
        'replied_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Comment $comment) {
            if ($comment->avatar) {
                ImageUpload::delete($comment->avatar);
            }
        });
    }

    public function hasReply(): bool
    {
        return ! is_null($this->reply);
    }
}
