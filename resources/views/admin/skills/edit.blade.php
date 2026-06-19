@extends('admin.layout')
@section('title', 'Edit Skill')
@section('page-title', 'Edit Skill')
@section('page-subtitle', $skill->name)

@section('content')
<div style="max-width:600px;">
    <div class="admin-card">
        <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
            @csrf @method('PUT')
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Nama Skill *</label>
                <input type="text" name="name" value="{{ old('name', $skill->name) }}" class="admin-input" required>
            </div>
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Kategori *</label>
                <input type="text" name="category" value="{{ old('category', $skill->category) }}" class="admin-input" required>
            </div>
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Level *</label>
                <select name="level" class="admin-input" required>
                    @foreach(['Beginner','Intermediate','Advanced','Expert'] as $level)
                    <option value="{{ $level }}" {{ $skill->level == $level ? 'selected' : '' }}>{{ $level }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom:1.5rem;">
                <label class="admin-label">Deskripsi</label>
                <textarea name="description" rows="3" class="admin-input">{{ old('description', $skill->description) }}</textarea>
            </div>
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}" class="admin-input">
            </div>
            <div style="display:flex; gap:0.75rem;">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('admin.skills.index') }}" class="admin-btn admin-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection