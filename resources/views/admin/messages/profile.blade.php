@extends('admin.layout')
@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')
@section('page-subtitle', 'Kelola informasi profil publik')

@section('content')
<div style="max-width:700px;">
    <div class="admin-card">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Nama *</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name ?? '') }}" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">Profesi / Title *</label>
                    <input type="text" name="title" value="{{ old('title', $profile->title ?? '') }}" class="admin-input" required>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Tagline *</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline ?? '') }}" class="admin-input" required>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Bio Singkat *</label>
                <textarea name="short_bio" rows="2" class="admin-input" required>{{ old('short_bio', $profile->short_bio ?? '') }}</textarea>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Bio Lengkap</label>
                <textarea name="long_bio" rows="5" class="admin-input">{{ old('long_bio', $profile->long_bio ?? '') }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email ?? '') }}" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">No. HP / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="admin-input">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Instagram URL</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $profile->instagram ?? '') }}" class="admin-input">
                </div>
                <div>
                    <label class="admin-label">GitHub URL</label>
                    <input type="url" name="github" value="{{ old('github', $profile->github ?? '') }}" class="admin-input">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">LinkedIn URL</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin ?? '') }}" class="admin-input">
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
                    <img src="{{ \App\Support\ImageUpload::url($profile->photo) }}" style="height:4rem; border-radius:0.5rem; object-fit:cover; margin-bottom:0.5rem; display:block;">
                    @endif
                    <input type="file" name="photo" accept="image/*" class="admin-input" style="padding:0.5rem;">
                </div>
                <div>
                    <label class="admin-label">File CV (PDF)</label>
                    @if($profile && $profile->cv_file)
                    <p style="font-size:0.75rem; color:#4ade80; margin-bottom:0.5rem;"><i class="fas fa-check-circle"></i> CV sudah diupload</p>
                    @endif
                    <input type="file" name="cv_file" accept=".pdf" class="admin-input" style="padding:0.5rem;">
                </div>
            </div>

            <button type="submit" class="admin-btn admin-btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection