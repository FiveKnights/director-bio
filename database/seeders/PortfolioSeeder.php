<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Imports what is currently listed in config/portfolio.php.
     * Uses firstOrCreate everywhere, so running it again never overwrites
     * anything you edited in the admin.
     */
    public function run(): void
    {
        // Skill categories (the "ALL" filter is added automatically by the site)
        foreach (collect(config('portfolio.skill_categories', []))->reject(fn ($c) => $c['id'] === 'ALL')->values() as $i => $c) {
            SkillCategory::firstOrCreate(['slug' => $c['id']], ['label' => $c['label'], 'sort_order' => $i]);
        }

        // Project statuses
        $statuses = ['DEPLOYED' => 'green', 'IN PROGRESS' => 'blue', 'PROTOTYPE' => 'amber', 'PLANNED' => 'gray', 'ARCHIVED' => 'red'];
        $i = 0;
        foreach ($statuses as $name => $color) {
            ProjectStatus::firstOrCreate(['name' => $name], ['color' => $color, 'sort_order' => $i++]);
        }

        // Projects
        foreach (config('portfolio.projects', []) as $i => $p) {
            Project::firstOrCreate(['code' => $p['code']], [
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

        // Skills
        foreach (config('portfolio.skills', []) as $i => $s) {
            Skill::firstOrCreate(['name' => $s['name']], [
                'category'    => $s['category'],
                'level'       => $s['level'],
                'description' => $s['desc'],
                'sort_order'  => $i,
            ]);
        }

        // Any status already used by a project but not listed above
        foreach (Project::query()->pluck('status')->unique() as $name) {
            ProjectStatus::firstOrCreate(['name' => $name], ['color' => 'amber', 'sort_order' => 99]);
        }

        // Experience
        foreach (config('portfolio.experience', []) as $i => $e) {
            Experience::firstOrCreate(['title' => $e['title'], 'period' => $e['period']], [
                'type'        => $e['type'],
                'icon'        => $e['icon'],
                'org'         => $e['org'] ?? null,
                'description' => $e['desc'] ?? null,
                'tags'        => $e['tags'] ?? [],
                'is_current'  => ! empty($e['current']),
                'sort_order'  => $i,
            ]);
        }

        // Social links
        foreach (config('portfolio.socials', []) as $i => $s) {
            SocialLink::firstOrCreate(['name' => $s['name']], [
                'handle'      => $s['handle'],
                'icon'        => $s['icon'] ?? 'fa-solid fa-link',
                'description' => $s['desc'] ?? null,
                'url'         => $s['url'],
                'sort_order'  => $i,
            ]);
        }
    }
}