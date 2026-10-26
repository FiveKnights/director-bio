<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::query()->delete();

        $projects = [
            [
                'code' => 'OP-01',
                'title' => 'IoT Home Security Integration',
                'status' => 'DEPLOYED',
                'short_desc' => 'ESP32-CAM microcontroller surveillance network linked with CodeIgniter 4 dynamic web dashboard.',
                'full_desc' => 'Comprehensive IoT security platform featuring live camera video feeds from ESP32-CAM hardware modules directly routed into a light web terminal.',
                'tags' => ['ESP32-CAM', 'CodeIgniter 4', 'C++', 'MySQL'],
                'highlights' => [
                    'Real-time video frame streaming over HTTP protocol.',
                    'CodeIgniter 4 backend auth and event logging table.',
                    'Low-latency hardware-to-cloud payload dispatch.',
                ],
            ],
            [
                'code' => 'OP-02',
                'title' => 'PRTS Tactical Portfolio Core',
                'status' => 'DEPLOYED',
                'short_desc' => 'High-performance single page application built with HAAVK / Endfield corporate terminal aesthetic.',
                'full_desc' => 'A light/dark corporate tactical terminal designed for Director Frost. Features custom Web Audio API synthesizer feedback.',
                'tags' => ['Tailwind CSS', 'Alpine.js', 'Web Audio API'],
                'highlights' => [
                    'Zero-dependency Alpine.js SPA router architecture.',
                    'Synthesizer pitch generation on click/tab interaction.',
                    'Slate & Dark tactical UI modes with local storage state.',
                ],
            ],
        ];

        foreach ($projects as $projectData) {
            $highlights = $projectData['highlights'];
            unset($projectData['highlights']);

            $project = Project::create($projectData);

            foreach ($highlights as $index => $text) {
                $project->highlights()->create([
                    'text' => $text,
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
