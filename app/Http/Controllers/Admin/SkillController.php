<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('sort_order')->paginate(15);

        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'required|in:Beginner,Intermediate,Advanced,Expert',
        ]);

        Skill::create($request->except('_token'));

        return redirect()->route('admin.skills.index')->with('success', 'Skill berhasil ditambahkan!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'required|in:Beginner,Intermediate,Advanced,Expert',
        ]);

        $skill->update($request->except(['_token', '_method']));

        return redirect()->route('admin.skills.index')->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return back()->with('success', 'Skill berhasil dihapus!');
    }
}
