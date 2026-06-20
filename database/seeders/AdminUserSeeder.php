<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Wisnu Nugroho',
            'email'    => 'F1E124032@gmail.com',
            'password' => Hash::make('F1E124032'),
        ]);
    }
}