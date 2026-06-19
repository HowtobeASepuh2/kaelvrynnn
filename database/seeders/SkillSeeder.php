<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            [
                'name'        => 'Canva',
                'category'    => 'Design Tool',
                'level'       => 'Advanced',
                'description' => 'Digunakan untuk membuat desain media sosial, poster, presentasi, dan kebutuhan promosi visual.',
                'icon'        => 'canva',
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Figma',
                'category'    => 'UI/UX Tool',
                'level'       => 'Intermediate',
                'description' => 'Digunakan untuk membuat desain UI, prototype, user flow, dan rancangan tampilan aplikasi atau website.',
                'icon'        => 'figma',
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Adobe Photoshop',
                'category'    => 'Graphic Design',
                'level'       => 'Intermediate',
                'description' => 'Digunakan untuk editing foto, manipulasi visual, dan pembuatan desain grafis berkualitas tinggi.',
                'icon'        => 'photoshop',
                'sort_order'  => 3,
            ],
            [
                'name'        => 'CapCut',
                'category'    => 'Video Editing',
                'level'       => 'Intermediate',
                'description' => 'Digunakan untuk mengedit video pendek, konten promosi, subtitle, dan transisi video.',
                'icon'        => 'capcut',
                'sort_order'  => 4,
            ],
            [
                'name'        => 'PixelLab',
                'category'    => 'Design Tool',
                'level'       => 'Intermediate',
                'description' => 'Digunakan untuk desain tipografi, poster, dan editing gambar di perangkat mobile.',
                'icon'        => 'pixellab',
                'sort_order'  => 5,
            ],
            [
                'name'        => 'PicsArt',
                'category'    => 'Design Tool',
                'level'       => 'Intermediate',
                'description' => 'Digunakan untuk editing foto kreatif, kolase, dan desain konten media sosial.',
                'icon'        => 'picsart',
                'sort_order'  => 6,
            ],
            [
                'name'        => 'Alight Motion',
                'category'    => 'Video Editing',
                'level'       => 'Intermediate',
                'description' => 'Digunakan untuk motion graphic, animasi teks, dan efek visual pada video.',
                'icon'        => 'alightmotion',
                'sort_order'  => 7,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}