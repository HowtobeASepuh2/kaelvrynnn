@extends('admin.layout')
@section('title', 'Tambah Project')
@section('page-title', 'Tambah Project')
@section('page-subtitle', 'Buat project baru untuk portofolio')

@section('content')
<div style="max-width:800px;">
    <div class="admin-card">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Judul Project *</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="admin-input" placeholder="Nama project" required>
                    @error('title')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="admin-label">Kategori *</label>
                    <select name="category_id" class="admin-input" required>
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Deskripsi *</label>
                <textarea name="description" rows="4" class="admin-input" placeholder="Deskripsi project..." required>{{ old('description') }}</textarea>
                @error('description')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Tujuan Project</label>
                <textarea name="objective" rows="3" class="admin-input" placeholder="Tujuan dari project ini...">{{ old('objective') }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Tools yang Digunakan *</label>
                    <input type="text" name="tools" value="{{ old('tools') }}" class="admin-input" placeholder="Canva, Figma, Photoshop" required>
                    <p style="font-size:0.75rem; color:#475569; margin-top:0.25rem;">Pisahkan dengan koma</p>
                </div>
                <div>
                    <label class="admin-label">Tahun *</label>
                    <input type="text" name="year" value="{{ old('year', date('Y')) }}" class="admin-input" placeholder="2025" required>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Link Demo (opsional)</label>
                <input type="url" name="demo_link" value="{{ old('demo_link') }}" class="admin-input" placeholder="https://...">
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Thumbnail Project</label>
                <input type="file" name="thumbnail" accept="image/*" class="admin-input" style="padding:0.5rem;">
                <p style="font-size:0.75rem; color:#475569; margin-top:0.25rem;">Format: JPG, PNG, WebP. Maks 2MB.</p>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label class="admin-label">Gambar Galeri Tambahan</label>
                <input type="file" name="images[]" accept="image/*" multiple class="admin-input" style="padding:0.5rem;">
                <p style="font-size:0.75rem; color:#475569; margin-top:0.25rem;">Bisa pilih beberapa gambar sekaligus.</p>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        style="width:1rem; height:1rem; accent-color:#7c3aed;">
                    <span style="font-size:0.875rem; color:#94a3b8;">Tampilkan sebagai Featured Project di Home</span>
                </label>
            </div>

            <div style="display:flex; gap:0.75rem;">
                <button type="submit" class="admin-btn admin-btn-primary">
                    <i class="fas fa-save"></i> Simpan Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection