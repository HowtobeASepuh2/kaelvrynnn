<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Support\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();

        return view('admin.profile', compact('profile'));
    }

    public function update(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'title'     => 'required|string|max:255',
        'tagline'   => 'required|string|max:255',
        'short_bio' => 'required|string',
        'email'     => 'required|email',
        'photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'cv_file'   => 'nullable|mimes:pdf|max:5120',
    ]);

    $profile = Profile::first();
    $data    = $request->except(['photo', 'cv_file', '_token', '_method']);

    if ($request->hasFile('photo')) {
        // Hapus foto lama dari Cloudinary
        if ($profile && $profile->photo && str_starts_with($profile->photo, 'http')) {
            \App\Support\ImageUpload::delete($profile->photo);
        } elseif ($profile && $profile->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->photo);
        }
        // Upload ke Cloudinary
        $data['photo'] = \App\Support\ImageUpload::store($request->file('photo'), 'profiles', 800);
    }

    if ($request->hasFile('cv_file')) {
        if ($profile && $profile->cv_file) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->cv_file);
        }
        $data['cv_file'] = $request->file('cv_file')->store('profiles', 'public');
    }

    if ($profile) {
        $profile->update($data);
    } else {
        Profile::create($data);
    }

    return back()->with('success', 'Profil berhasil diperbarui!');
}
}
