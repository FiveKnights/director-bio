<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        Skill::query()->delete();

        Skill::insert([
            [
                'name' => 'Laravel Framework',
                'category' => 'BACKEND',
                'level' => 95,
                'description' => 'REST APIs, ORM Eloquent, Authentication, Middleware.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CodeIgniter 4',
                'category' => 'BACKEND',
                'level' => 90,
                'description' => 'Lightweight PHP backend engines, high-speed routing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ESP32 / ESP32-CAM',
                'category' => 'HARDWARE',
                'level' => 88,
                'description' => 'C++ Arduino core, HTTP video streams, GPIO sensor data.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MySQL & SQLite',
                'category' => 'BACKEND',
                'level' => 92,
                'description' => 'Relational database schema optimization, indexing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
