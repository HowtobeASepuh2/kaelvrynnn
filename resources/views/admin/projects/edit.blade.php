@extends('admin.layout')
@section('title', 'Edit Project')
@section('page-title', 'Edit Project')
@section('page-subtitle', $project->title)

@section('content')
<div style="max-width:800px;">
    <div class="admin-card">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Judul Project *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">Kategori *</label>
                    <select name="category_id" class="admin-input" required>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $project->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Deskripsi *</label>
                <textarea name="description" rows="4" class="admin-input" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Tujuan Project</label>
                <textarea name="objective" rows="3" class="admin-input">{{ old('objective', $project->objective) }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Tools *</label>
                    <input type="text" name="tools" value="{{ old('tools', $project->tools) }}" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">Tahun *</label>
                    <input type="text" name="year" value="{{ old('year', $project->year) }}" class="admin-input" required>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Link Demo</label>
                <input type="url" name="demo_link" value="{{ old('demo_link', $project->demo_link) }}" class="admin-input">
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Ganti Thumbnail</label>
                @if($project->thumbnail)
                <div style="margin-bottom:0.5rem;">
                    <img src="{{ Storage::url($project->thumbnail) }}" style="height:5rem; border-radius:0.5rem; object-fit:cover;">
                </div>
                @endif
                <input type="file" name="thumbnail" accept="image/*" class="admin-input" style="padding:0.5rem;">
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Tambah Gambar Galeri</label>
                @if($project->images->count() > 0)
                <div style="display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:0.5rem;">
                    @foreach($project->images as $img)
                    <img src="{{ Storage::url($img->image) }}" style="height:4rem; border-radius:0.375rem; object-fit:cover;">
                    @endforeach
                </div>
                @endif
                <input type="file" name="images[]" accept="image/*" multiple class="admin-input" style="padding:0.5rem;">
            </div>

            <div style="margin-bottom:1.5rem;">
                <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }}
                        style="width:1rem; height:1rem; accent-color:#7c3aed;">
                    <span style="font-size:0.875rem; color:#94a3b8;">Featured Project</span>
                </label>
            </div>

            <div style="display:flex; gap:0.75rem;">
                <button type="submit" class="admin-btn admin-btn-primary">
                    <i class="fas fa-save"></i> Update Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection