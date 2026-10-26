<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $data = [
            'tabs'            => config('portfolio.tabs'),
            'skillCategories' => config('portfolio.skill_categories'),
            'experience' => config('portfolio.experience'),
            'skills'          => config('portfolio.skills'),
            'projects' => collect(config('portfolio.projects'))->map(function ($project) {
    $project['imageUrl'] = !empty($project['image']) ? asset($project['image']) : null;
    return $project;
})->all(),
            'statuses'        => config('portfolio.statuses'),
            'socials' => config('portfolio.socials'),
            'contactUrl' => route('contact.store', [], false),
        ];

        return view('portfolio.index', $data + ['portfolio' => $data]);
    }
}
