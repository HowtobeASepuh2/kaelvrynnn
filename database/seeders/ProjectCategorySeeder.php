<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;
use Illuminate\Support\Str;

class ProjectCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Graphic Design',
            'UI/UX Design',
            'Poster Design',
            'Social Media Design',
            'Video Editing',
            'Branding',
        ];

        foreach ($categories as $name) {
            ProjectCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}