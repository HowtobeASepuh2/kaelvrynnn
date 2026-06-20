<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageUpload
{
    public static function store(UploadedFile $file, string $directory, int $maxWidth = 1600): string
    {
        $result = Cloudinary::uploadApi()->upload($file->getRealPath(), [
            'folder'         => 'portofolio-wisnu/' . trim($directory, '/'),
            'public_id'      => Str::uuid(),
            'transformation' => [
                'width'   => $maxWidth,
                'crop'    => 'limit',
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ],
        ]);

        return $result['secure_url'];
    }

    public static function delete(string $url): void
    {
        if (empty($url)) {
            return;
        }

        if (!str_starts_with($url, 'http')) {
            Storage::disk('public')->delete($url);

            return;
        }

        // Extract public_id dari URL Cloudinary secure_url.
        if (preg_match('/\/upload\/(?:v\d+\/)?(.+?)(?:\.[a-zA-Z0-9]+)?$/', $url, $matches)) {
            Cloudinary::uploadApi()->destroy($matches[1]);
        }
    }

    public static function url(?string $path): ?string
{
    if (empty($path)) return null;

    // Kalau sudah URL penuh (Cloudinary), langsung return
    if (str_starts_with($path, 'http')) {
        return $path;
    }

    // Kalau path lokal, pakai Storage
    return Storage::url($path);
}
}
