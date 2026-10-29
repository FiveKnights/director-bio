<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $colors   = config('portfolio.status_colors', []);
        $fallback = $colors['amber'] ?? '';

        // Status name => Tailwind classes, used by the project badges
        $statuses = ProjectStatus::orderBy('sort_order')->orderBy('id')->get()
            ->mapWithKeys(fn ($s) => [$s->name => $colors[$s->color] ?? $fallback])
            ->all();
        $statuses['default'] = $fallback;

        $categories = SkillCategory::orderBy('sort_order')->orderBy('id')->get()
            ->map(fn ($c) => ['id' => $c->slug, 'label' => $c->label])
            ->all();

        // Sent to the page's JavaScript (Alpine) as window.PORTFOLIO_DATA
        $data = [
            'tabs'            => config('portfolio.tabs'),
            'skillCategories' => array_merge([['id' => 'ALL', 'label' => 'ALL_MODULES']], $categories),
            'skills'          => Skill::visible()->ordered()->get()->map->toPortfolio()->values()->all(),
            'projects'        => Project::visible()->ordered()->get()->map->toPortfolio()->values()->all(),
            'statuses'        => $statuses,
            'contactUrl'      => route('contact.store', [], false),
        ];

        return view('portfolio.index', $data + [
            'portfolio'  => $data,
            // Rendered by Blade only, so they stay out of the JavaScript data
            'experience' => Experience::where('is_visible', true)->orderBy('sort_order')->orderBy('id')->get()->map->toPortfolio()->values()->all(),
            'socials'    => SocialLink::where('is_visible', true)->orderBy('sort_order')->orderBy('id')->get()->map->toPortfolio()->values()->all(),
        ]);
    }
}