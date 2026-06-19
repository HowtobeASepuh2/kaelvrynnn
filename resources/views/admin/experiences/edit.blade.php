@extends('admin.layout')
@section('title', 'Edit Experience')
@section('page-title', 'Edit Experience')
@section('page-subtitle', $experience->title)

@section('content')
<div style="max-width:600px;">
    <div class="admin-card">
        <form action="{{ route('admin.experiences.update', $experience) }}" method="POST">
            @csrf @method('PUT')
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Tahun *</label>
                <input type="text" name="year" value="{{ old('year', $experience->year) }}" class="admin-input" required>
            </div>
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $experience->title) }}" class="admin-input" required>
            </div>
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Deskripsi *</label>
                <textarea name="description" rows="4" class="admin-input" required>{{ old('description', $experience->description) }}</textarea>
            </div>
            <div style="margin-bottom:1.5rem;">
                <label class="admin-label">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $experience->sort_order) }}" class="admin-input">
            </div>
            <div style="display:flex; gap:0.75rem;">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.experiences.index') }}" class="admin-btn admin-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection