@extends('admin.layout')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')
@section('content')
<div class="admin-card" style="max-width:42rem;">
    <form action="{{ route('admin.project-categories.update', $projectCategory) }}" method="POST" style="display:grid; gap:1rem;">
        @csrf @method('PUT')
        <div>
            <label class="admin-label">Nama</label>
            <input class="admin-input" name="name" value="{{ old('name', $projectCategory->name) }}" required>
            @error('name')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="admin-label">Slug</label>
            <input class="admin-input" name="slug" value="{{ old('slug', $projectCategory->slug) }}">
            @error('slug')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div style="display:flex; gap:0.75rem;">
            <button class="admin-btn admin-btn-primary">Simpan</button>
            <a href="{{ route('admin.project-categories.index') }}" class="admin-btn admin-btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
