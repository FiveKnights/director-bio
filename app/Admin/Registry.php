<?php

namespace App\Admin;

use App\Models\Experience;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;

/**
 * Describes every section of the admin panel. To add a field, add one line
 * to a 'fields' list; to add a whole section, add a block here (plus a model
 * and a table).
 *
 * Field options: name, label, short (table heading), type (text, url, number,
 * textarea, select, checkbox, tags, lines, image), required, max, min,
 * span (1-3 columns), default, help, placeholder, unique, immutable,
 * options (select), prefixes (url), dir (image), rows (textarea), extra_rules.
 */
class Registry
{
    public static function get(string $key): array
    {
        $all = static::all();
        abort_unless(isset($all[$key]), 404);

        return $all[$key];
    }

    public static function all(): array
    {
        $sort = [
            'name' => 'sort_order', 'label' => 'Order (lower first)', 'short' => 'Order', 'type' => 'number',
            'required' => true, 'default' => 0, 'span' => 1,
        ];
        $visible = [
            'name' => 'is_visible', 'label' => 'Show on site', 'short' => 'Visible', 'type' => 'checkbox',
            'default' => true, 'span' => 1,
        ];

        $badge = fn (string $text, string $color) => '<span class="px-2 py-0.5 text-[10px] font-tech font-bold border '
            . e(config('portfolio.status_colors.' . $color, '')) . '">' . e($text) . '</span>';

        return [

            'projects' => [
                'label' => 'Projects', 'singular' => 'Project', 'hint' => 'Cards on the Projects tab',
                'model' => Project::class,
                'columns' => ['image', 'code', 'title', 'status', 'sort_order', 'is_visible'],
                'fields' => [
                    ['name' => 'code', 'label' => 'Code', 'type' => 'text', 'required' => true, 'max' => 20, 'unique' => true, 'span' => 1, 'placeholder' => 'OP-03'],
                    ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'required' => true, 'max' => 150, 'span' => 2],
                    ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'required' => true, 'default' => 'IN PROGRESS', 'span' => 1,
                        'options' => fn () => ProjectStatus::orderBy('sort_order')->orderBy('id')->pluck('name', 'name')->all(),
                        'help' => 'Manage the list under Statuses.'],
                    $sort,
                    $visible,
                    ['name' => 'short_desc', 'label' => 'Short description (card)', 'type' => 'textarea', 'rows' => 2, 'required' => true, 'max' => 500],
                    ['name' => 'full_desc', 'label' => 'Full description (popup)', 'type' => 'textarea', 'rows' => 4, 'required' => true, 'max' => 3000],
                    ['name' => 'tags', 'label' => 'Tags (comma-separated)', 'type' => 'tags', 'max' => 300, 'placeholder' => 'Laravel, MySQL, ESP32'],
                    ['name' => 'highlights', 'label' => 'Key highlights (one per line)', 'type' => 'lines', 'max' => 2000],
                    ['name' => 'github_url', 'label' => 'GitHub URL', 'type' => 'url', 'span' => 3, 'placeholder' => 'https://github.com/...'],
                    ['name' => 'demo_url', 'label' => 'Live demo URL', 'type' => 'url', 'span' => 3, 'placeholder' => 'https://...'],
                    ['name' => 'image', 'label' => 'Screenshot (JPG, PNG or WebP, max 2 MB)', 'short' => 'Image', 'type' => 'image', 'dir' => 'img/projects'],
                ],
            ],

            'skills' => [
                'label' => 'Skills', 'singular' => 'Skill', 'hint' => 'Bars on the Skills tab',
                'model' => Skill::class,
                'columns' => ['name', 'category', 'level', 'sort_order', 'is_visible'],
                'fields' => [
                    ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true, 'max' => 100, 'unique' => true, 'span' => 2],
                    ['name' => 'category', 'label' => 'Category', 'type' => 'select', 'required' => true, 'span' => 1,
                        'options' => fn () => SkillCategory::orderBy('sort_order')->orderBy('id')->pluck('label', 'slug')->all(),
                        'help' => 'Manage the list under Categories.'],
                    ['name' => 'level', 'label' => 'Level (0-100)', 'short' => 'Level', 'type' => 'number', 'required' => true, 'min' => 0, 'max' => 100, 'default' => 50, 'span' => 1],
                    $sort,
                    $visible,
                    ['name' => 'description', 'label' => 'Description', 'type' => 'text', 'required' => true, 'max' => 255],
                ],
            ],

            'categories' => [
                'label' => 'Categories', 'singular' => 'Category', 'hint' => 'Skill filter buttons',
                'model' => SkillCategory::class,
                'columns' => ['slug', 'label', 'sort_order'],
                'fields' => [
                    ['name' => 'slug', 'label' => 'ID', 'type' => 'text', 'required' => true, 'max' => 40, 'unique' => true, 'immutable' => true, 'span' => 1,
                        'placeholder' => 'DESIGN', 'extra_rules' => ['regex:/^[A-Z0-9_]+$/', 'not_in:ALL'],
                        'help' => 'UPPERCASE letters, digits, underscore. Cannot be changed later.'],
                    ['name' => 'label', 'label' => 'Button label', 'type' => 'text', 'required' => true, 'max' => 60, 'span' => 2, 'placeholder' => 'UI_DESIGN'],
                    $sort,
                ],
                'can_delete' => fn ($c) => Skill::where('category', $c->slug)->exists()
                    ? 'Move or delete the skills in this category first.' : null,
            ],

            'statuses' => [
                'label' => 'Statuses', 'singular' => 'Status', 'hint' => 'Project status badges',
                'model' => ProjectStatus::class,
                'columns' => ['name', 'color', 'sort_order'],
                'fields' => [
                    ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true, 'max' => 40, 'unique' => true, 'span' => 2, 'placeholder' => 'ON HOLD'],
                    ['name' => 'color', 'label' => 'Badge color', 'type' => 'select', 'required' => true, 'default' => 'amber', 'span' => 1,
                        'options' => fn () => collect(config('portfolio.status_colors'))->mapWithKeys(fn ($v, $k) => [$k => ucfirst($k)])->all()],
                    $sort,
                ],
                'render' => [
                    'name' => fn ($s) => $badge($s->name, $s->color),
                ],
                'can_delete' => fn ($s) => Project::where('status', $s->name)->exists()
                    ? 'Some projects still use this status.' : null,
                // Renaming a status updates the projects that use it
                'after_update' => function ($s, array $original) {
                    if (($original['name'] ?? $s->name) !== $s->name) {
                        Project::where('status', $original['name'])->update(['status' => $s->name]);
                    }
                },
            ],

            'experience' => [
                'label' => 'Experience', 'singular' => 'Entry', 'hint' => 'Timeline on the Profile tab',
                'model' => Experience::class,
                'columns' => ['type', 'title', 'period', 'is_current', 'sort_order', 'is_visible'],
                'fields' => [
                    ['name' => 'type', 'label' => 'Type', 'type' => 'text', 'required' => true, 'max' => 40, 'span' => 1, 'placeholder' => 'WORK', 'help' => 'WORK, EDUCATION, CERTIFICATION...'],
                    ['name' => 'period', 'label' => 'Period', 'type' => 'text', 'required' => true, 'max' => 40, 'span' => 1, 'placeholder' => '2023 - PRESENT'],
                    ['name' => 'icon', 'label' => 'Icon (Font Awesome classes)', 'type' => 'text', 'required' => true, 'max' => 60, 'default' => 'fa-solid fa-briefcase', 'span' => 1],
                    ['name' => 'title', 'label' => 'Title', 'type' => 'text', 'required' => true, 'max' => 150, 'span' => 2],
                    ['name' => 'org', 'label' => 'Organization', 'type' => 'text', 'max' => 150, 'span' => 1],
                    ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'rows' => 3, 'max' => 1000],
                    ['name' => 'tags', 'label' => 'Tags (comma-separated)', 'type' => 'tags', 'max' => 300],
                    ['name' => 'is_current', 'label' => 'Current (green badge)', 'short' => 'Current', 'type' => 'checkbox', 'default' => false, 'span' => 1],
                    $sort,
                    $visible,
                ],
            ],

            'socials' => [
                'label' => 'Links', 'singular' => 'Link', 'hint' => 'Social cards on the Contact tab',
                'model' => SocialLink::class,
                'columns' => ['name', 'handle', 'url', 'sort_order', 'is_visible'],
                'fields' => [
                    ['name' => 'name', 'label' => 'Platform', 'type' => 'text', 'required' => true, 'max' => 40, 'span' => 1, 'placeholder' => 'GITHUB'],
                    ['name' => 'handle', 'label' => 'Handle / text', 'type' => 'text', 'required' => true, 'max' => 100, 'span' => 1, 'placeholder' => '@yourusername'],
                    ['name' => 'icon', 'label' => 'Icon (Font Awesome classes)', 'type' => 'text', 'required' => true, 'max' => 60, 'default' => 'fa-brands fa-github', 'span' => 1],
                    ['name' => 'url', 'label' => 'URL', 'type' => 'url', 'required' => true, 'prefixes' => ['http://', 'https://', 'mailto:'], 'placeholder' => 'https://... or mailto:you@example.com'],
                    ['name' => 'description', 'label' => 'Description', 'type' => 'text', 'max' => 255],
                    $sort,
                    $visible,
                ],
            ],
        ];
    }
}