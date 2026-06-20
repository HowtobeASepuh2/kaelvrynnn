<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'year' => '2023',
                'title' => 'Awal Belajar Desain',
                'description' => 'Mulai mengenal desain grafis, belajar dasar layout, warna, tipografi, dan editing visual menggunakan Canva dan PixelLab.',
                'sort_order' => 1,
            ],
            [
                'year' => '2024',
                'title' => 'Aktif Membuat Konten Visual',
                'description' => 'Mulai aktif membuat desain untuk kebutuhan organisasi, media sosial, promosi, dan tugas kuliah. Mulai mempelajari Figma dan Adobe Photoshop.',
                'sort_order' => 2,
            ],
            [
                'year' => '2025',
                'title' => 'Mengembangkan Portofolio Kreatif',
                'description' => 'Mulai serius membangun personal branding, membuat project desain UI/UX, video editing, dan portofolio digital yang lebih terstruktur.',
                'sort_order' => 3,
            ],
            [
                'year' => '2026',
                'title' => 'Fokus Profesional',
                'description' => 'Mengembangkan portofolio berbasis website, memperkuat skill desain, dan mulai menyiapkan diri untuk peluang freelance, magang, atau kerja kreatif.',
                'sort_order' => 4,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }
    }
}
