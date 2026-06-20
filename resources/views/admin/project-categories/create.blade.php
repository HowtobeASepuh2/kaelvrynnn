@extends('admin.layout')
@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')
@section('content')
<div class="admin-card" style="max-width:42rem;">
    <form action="{{ route('admin.project-categories.store') }}" method="POST" style="display:grid; gap:1rem;">
        @csrf
        <div>
            <label class="admin-label">Nama</label>
            <input class="admin-input" name="name" value="{{ old('name') }}" required>
            @error('name')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="admin-label">Slug Opsional</label>
            <input class="admin-input" name="slug" value="{{ old('slug') }}">
            @error('slug')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div style="display:flex; gap:0.75rem;">
            <button class="admin-btn admin-btn-primary">Simpan</button>
            <a href="{{ route('admin.project-categories.index') }}" class="admin-btn admin-btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
