<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'name'       => 'Wisnu Nugroho',
            'title'      => 'Graphic Designer & Creative Editor',
            'tagline'    => 'Designing visuals that speak, move, and connect.',
            'short_bio'  => 'Mahasiswa Sistem Informasi yang tertarik pada desain grafis, UI/UX, branding, dan video editing.',
            'long_bio'   => 'Saya adalah mahasiswa Sistem Informasi yang memiliki minat kuat pada desain grafis, visual editing, UI/UX, dan content design. Saya terbiasa membuat desain untuk kebutuhan organisasi, media sosial, promosi, presentasi, dan project digital. Bagi saya, desain bukan hanya soal tampilan yang menarik, tetapi juga bagaimana pesan dapat tersampaikan dengan jelas dan efektif.',
            'email'      => 'wisnu@email.com',
            'phone'      => '+62 812-3456-7890',
            'instagram'  => 'https://instagram.com/wisnunugroho',
            'github'     => 'https://github.com/wisnunugroho',
            'linkedin'   => 'https://linkedin.com/in/wisnunugroho',
            'whatsapp'   => 'https://wa.me/6281234567890',
        ]);
    }
}