<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        // Sent to the page's JavaScript (Alpine) as window.PORTFOLIO_DATA
        $data = [
            'tabs'            => config('portfolio.tabs'),
            'skillCategories' => config('portfolio.skill_categories'),
            'skills'          => Skill::visible()->ordered()->get()->map->toPortfolio()->values()->all(),
            'projects'        => Project::visible()->ordered()->get()->map->toPortfolio()->values()->all(),
            'statuses'        => config('portfolio.statuses'),
            'contactUrl'      => route('contact.store', [], false),
        ];

        return view('portfolio.index', $data + [
            'portfolio'  => $data,
            // Rendered by Blade only, so they don't need to go into the JavaScript data
            'experience' => config('portfolio.experience', []),
            'socials'    => config('portfolio.socials', []),
        ]);
    }
}