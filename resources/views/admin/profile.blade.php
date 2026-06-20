@extends('admin.layout')
@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')
@section('page-subtitle', 'Kelola informasi profil publik')

@section('content')
<div style="width:100%;">
    <div class="admin-card">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Nama *</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name ?? '') }}" class="admin-input" required>
                    @error('name')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="admin-label">Profesi / Title *</label>
                    <input type="text" name="title" value="{{ old('title', $profile->title ?? '') }}" class="admin-input" required>
                    @error('title')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Tagline *</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline ?? '') }}" class="admin-input" placeholder="Designing visuals that speak, move, and connect." required>
                @error('tagline')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Bio Singkat *</label>
                <textarea name="short_bio" rows="2" class="admin-input" required>{{ old('short_bio', $profile->short_bio ?? '') }}</textarea>
                @error('short_bio')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Bio Lengkap</label>
                <textarea name="long_bio" rows="5" class="admin-input" placeholder="Ceritakan lebih lengkap tentang dirimu...">{{ old('long_bio', $profile->long_bio ?? '') }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email ?? '') }}" class="admin-input" required>
                    @error('email')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="admin-label">No. HP / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="admin-input" placeholder="+62 812-3456-7890">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Instagram URL</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $profile->instagram ?? '') }}" class="admin-input" placeholder="https://instagram.com/username">
                </div>
                <div>
                    <label class="admin-label">GitHub URL</label>
                    <input type="url" name="github" value="{{ old('github', $profile->github ?? '') }}" class="admin-input" placeholder="https://github.com/username">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">LinkedIn URL</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin ?? '') }}" class="admin-input" placeholder="https://linkedin.com/in/username">
                </div>
                <div>
                    <label class="admin-label">WhatsApp URL</label>
                    <input type="url" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp ?? '') }}" class="admin-input" placeholder="https://wa.me/628...">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem;">
                <div>
                    <label class="admin-label">Foto Profil</label>
                    @if($profile && $profile->photo)
                    <div style="margin-bottom:0.5rem;">
                        <img src="{{ \App\Support\ImageUpload::url($profile->photo) }}"
                             style="height:5rem; width:5rem; border-radius:0.75rem; object-fit:cover; border:1px solid rgba(255,255,255,0.1);">
                        <p style="font-size:0.7rem; color:#4ade80; margin-top:0.25rem;"><i class="fas fa-check-circle"></i> Foto sudah ada</p>
                    </div>
                    @endif
                    <input type="file" name="photo" accept="image/*" class="admin-input" style="padding:0.5rem;">
                    <p style="font-size:0.7rem; color:#475569; margin-top:0.25rem;">Format: JPG, PNG. Maks 2MB.</p>
                </div>
                <div>
                    <label class="admin-label">File CV (PDF)</label>
                    @if($profile && $profile->cv_file)
                    <div style="margin-bottom:0.5rem;">
                        <a href="{{ Storage::url($profile->cv_file) }}" target="_blank" rel="noopener noreferrer"
                           style="font-size:0.75rem; color:#22d3ee; text-decoration:none;">
                            <i class="fas fa-file-pdf"></i> Lihat CV yang ada
                        </a>
                        <p style="font-size:0.7rem; color:#4ade80; margin-top:0.25rem;"><i class="fas fa-check-circle"></i> CV sudah diupload</p>
                    </div>
                    @endif
                    <input type="file" name="cv_file" accept=".pdf" class="admin-input" style="padding:0.5rem;">
                    <p style="font-size:0.7rem; color:#475569; margin-top:0.25rem;">Format: PDF. Maks 5MB.</p>
                </div>
            </div>

            <div style="display:flex; gap:0.75rem; padding-top:1rem; border-top:1px solid rgba(255,255,255,0.06);">
                <button type="submit" class="admin-btn admin-btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
