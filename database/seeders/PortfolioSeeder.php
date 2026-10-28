<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /** Imports the projects and skills currently listed in config/portfolio.php. */
    public function run(): void
    {
        foreach (config('portfolio.projects', []) as $i => $p) {
            Project::updateOrCreate(['code' => $p['code']], [
                'title'      => $p['title'],
                'status'     => $p['status'],
                'short_desc' => $p['shortDesc'],
                'full_desc'  => $p['fullDesc'],
                'tags'       => $p['tags'] ?? [],
                'highlights' => $p['highlights'] ?? [],
                'image'      => $p['image'] ?? null,
                'github_url' => $p['links']['github'] ?? null,
                'demo_url'   => $p['links']['demo'] ?? null,
                'sort_order' => $i,
            ]);
        }

        foreach (config('portfolio.skills', []) as $i => $s) {
            Skill::updateOrCreate(['name' => $s['name']], [
                'category'    => $s['category'],
                'level'       => $s['level'],
                'description' => $s['desc'],
                'sort_order'  => $i,
            ]);
        }
    }
}