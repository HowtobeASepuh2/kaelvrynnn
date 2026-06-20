<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::where('email', 'F1E124032@gmail.com')
            ->update([
                'is_admin' => true,
                'password' => Hash::make('F1E124032'),
            ]);
    }
}