@extends('admin.layout')
@section('title', 'Tambah Experience')
@section('page-title', 'Tambah Experience')

@section('content')
<div style="max-width:600px;">
    <div class="admin-card">
        <form action="{{ route('admin.experiences.store') }}" method="POST">
            @csrf
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Tahun *</label>
                <input type="text" name="year" value="{{ old('year') }}" class="admin-input" placeholder="2025" required>
            </div>
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Judul *</label>
                <input type="text" name="title" value="{{ old('title') }}" class="admin-input" placeholder="Judul pengalaman" required>
            </div>
            <div style="margin-bottom:1rem;">
                <label class="admin-label">Deskripsi *</label>
                <textarea name="description" rows="4" class="admin-input" placeholder="Ceritakan pengalamanmu..." required>{{ old('description') }}</textarea>
            </div>
            <div style="margin-bottom:1.5rem;">
                <label class="admin-label">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="admin-input">
            </div>
            <div style="display:flex; gap:0.75rem;">
                <button type="submit" class="admin-btn admin-btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.experiences.index') }}" class="admin-btn admin-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection