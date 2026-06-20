<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->paginate(15);

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Experience::create($request->except('_token'));

        return redirect()->route('admin.experiences.index')->with('success', 'Experience berhasil ditambahkan!');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $request->validate([
            'year' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $experience->update($request->except(['_token', '_method']));

        return redirect()->route('admin.experiences.index')->with('success', 'Experience berhasil diperbarui!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return back()->with('success', 'Experience berhasil dihapus!');
    }
}
