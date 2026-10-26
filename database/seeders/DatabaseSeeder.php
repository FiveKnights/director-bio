<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'FROSTED'],
            [
                'name' => 'Director Frost',
                'email' => 'frost@example.com',
                'password' => Hash::make('change-this-password'),
            ]
        );

        $this->call([
            SkillSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
