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
            'title'      => 'UI UX Deisgner & Creative Editor',
            'tagline'    => 'Mahasiswa Sistem Informasi Universitas Jambi.',
            'short_bio'  => 'Mahasiswa Sistem Informasi Universitas Jambi yang tertarik pada desain grafis, UI/UX, branding, dan video editing. Mengikuti cukup banyak organisasi, mulai dari Himpunan, UKM, dan juga organisasi di luar kampus.',
            'long_bio'   => 'Saya adalah mahasiswa Sistem Informasi Universitas yang memiliki minat kuat pada desain grafis, visual editing, UI/UX, dan content design. Saya terbiasa membuat desain untuk kebutuhan organisasi, media sosial, promosi, presentasi, dan project digital. Bagi saya, desain bukan hanya soal tampilan yang menarik, tetapi juga bagaimana pesan dapat tersampaikan dengan jelas dan efektif.',
            'email'      => 'wisnungrh2@gmail.com',
            'phone'      => '+62 812-8812-1864',
            'instagram'  => 'https://instagram.com/_wisnungrh2',
            'github'     => 'https://github.com/HowtobeASepuh2',
            'linkedin'   => 'https://linkedin.com/in/wisnungrh2',
            'whatsapp'   => 'https://wa.me/6281288121864',
        ]);
    }
}