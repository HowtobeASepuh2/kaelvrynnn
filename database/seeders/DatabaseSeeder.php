<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ProfileSeeder::class,
            SkillSeeder::class,
            ExperienceSeeder::class,
            ProjectCategorySeeder::class,
        ]);
    }
}