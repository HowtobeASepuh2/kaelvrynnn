<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageUpload
{
    public static function store(UploadedFile $file, string $directory, int $maxWidth = 1600): string
    {
        $path = trim($directory, '/').'/'.Str::uuid().'.webp';
        $image = Image::read($file->getRealPath())->scaleDown(width: $maxWidth);

        Storage::disk('public')->put($path, (string) $image->toWebp(quality: 82));

        return $path;
    }
}
