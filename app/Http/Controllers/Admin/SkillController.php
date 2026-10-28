<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        return view('admin.skills.index', [
            'skills' => Skill::ordered()->get(),
        ]);
    }

    public function create(): View
    {
        $skill = new Skill([
            'level'      => 50,
            'is_visible' => true,
            'sort_order' => ((int) Skill::max('sort_order')) + 1,
        ]);

        return view('admin.skills.form', compact('skill'));
    }

    public function store(SkillRequest $request): RedirectResponse
    {
        Skill::create($this->payload($request));

        return redirect()->route('admin.skills.index')->with('status', 'Skill created.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(SkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($this->payload($request));

        return redirect()->route('admin.skills.index')->with('status', 'Skill updated.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('status', 'Skill deleted.');
    }

    private function payload(SkillRequest $request): array
    {
        $v = $request->validated();

        return [
            'name'        => $v['name'],
            'category'    => $v['category'],
            'level'       => $v['level'],
            'description' => $v['description'],
            'sort_order'  => $v['sort_order'] ?? 0,
            'is_visible'  => $request->boolean('is_visible'),
        ];
    }
}