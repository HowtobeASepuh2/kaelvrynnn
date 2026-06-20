@extends('admin.layout')
@section('title', 'Edit Project')
@section('page-title', 'Edit Project')
@section('page-subtitle', $project->title)

@section('content')
<div style="width:100%;">
    <div class="admin-card">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div>
                    <label class="admin-label">Judul Project *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" class="admin-input" required>
                </div>
                <div>
                    <label class="admin-label">Custom Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $project->slug) }}" class="admin-input" placeholder="poster-event-kampus">
                    @error('slug')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
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
                <div>
                    <label class="admin-label">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" class="admin-input" placeholder="0">
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

            <div style="margin-bottom:1rem; padding:1rem; border:1px solid rgba(255,255,255,0.06); border-radius:0.75rem; background:rgba(255,255,255,0.02);">
                <h3 style="font-size:0.95rem; font-weight:600; color:#f1f5f9; margin:0 0 1rem;">Konteks Project</h3>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                    <div>
                        <label class="admin-label">Status Project</label>
                        <select name="project_status" class="admin-input">
                            <option value="">Pilih status</option>
                            @foreach(['Learning Project', 'College Assignment', 'Personal Experiment', 'Portfolio Practice', 'Client/Freelance'] as $status)
                            <option value="{{ $status }}" {{ old('project_status', $project->project_status) === $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="admin-label">Role Saya</label>
                        <input type="text" name="role" value="{{ old('role', $project->role) }}" class="admin-input" placeholder="Contoh: UI Designer, Graphic Designer">
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div>
                        <label class="admin-label">Durasi</label>
                        <input type="text" name="duration" value="{{ old('duration', $project->duration) }}" class="admin-input" placeholder="Contoh: 2 minggu">
                    </div>
                    <div>
                        <label class="admin-label">Hasil / Insight</label>
                        <textarea name="impact" rows="2" class="admin-input" placeholder="Apa hasil atau pembelajaran dari project ini?">{{ old('impact', $project->impact) }}</textarea>
                    </div>
                </div>
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

            <div style="margin-bottom:1rem; padding:1rem; border:1px solid rgba(255,255,255,0.06); border-radius:0.75rem; background:rgba(255,255,255,0.02);">
                <h3 style="font-size:0.95rem; font-weight:600; color:#f1f5f9; margin:0 0 1rem;">SEO Project</h3>
                <div style="margin-bottom:1rem;">
                    <label class="admin-label">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $project->seo_title) }}" class="admin-input" placeholder="Judul khusus untuk Google/social preview">
                </div>
                <div style="margin-bottom:1rem;">
                    <label class="admin-label">SEO Description</label>
                    <textarea name="seo_description" rows="2" class="admin-input" maxlength="255" placeholder="Ringkasan singkat untuk hasil pencarian">{{ old('seo_description', $project->seo_description) }}</textarea>
                </div>
                <div>
                    <label class="admin-label">SEO Keywords</label>
                    <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $project->seo_keywords) }}" class="admin-input" placeholder="portfolio, desain grafis, UI UX">
                    <p style="font-size:0.75rem; color:#475569; margin-top:0.25rem;">Pisahkan keyword dengan koma.</p>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Ganti Thumbnail</label>
                @if($project->thumbnail)
                <div style="margin-bottom:0.5rem;">
                    <img src="{{ \App\Support\ImageUpload::url($project->thumbnail) }}" style="height:5rem; border-radius:0.5rem; object-fit:cover;">
                </div>
                @endif
                <input type="file" name="thumbnail" accept="image/*" class="admin-input" style="padding:0.5rem;">
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Open Graph Image</label>
                @if($project->og_image)
                <div style="margin-bottom:0.5rem;">
                    <img src="{{ \App\Support\ImageUpload::url($project->og_image) }}" style="height:5rem; border-radius:0.5rem; object-fit:cover;">
                    <p style="font-size:0.7rem; color:#4ade80; margin-top:0.25rem;">OG image sudah ada</p>
                </div>
                @endif
                <input type="file" name="og_image" accept="image/*" class="admin-input" style="padding:0.5rem;">
                <p style="font-size:0.75rem; color:#475569; margin-top:0.25rem;">Gambar preview saat link dibagikan. Jika kosong, thumbnail dipakai.</p>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Tambah Gambar Galeri</label>
                @if($project->images->count() > 0)
                <div style="display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:0.5rem;">
                    @foreach($project->images as $img)
                    <div style="position:relative;">
                        <img src="{{ \App\Support\ImageUpload::url($img->image) }}" style="height:4rem; width:4rem; border-radius:0.375rem; object-fit:cover;">
                        <form action="{{ route('admin.projects.images.destroy', $img) }}" method="POST" onsubmit="event.preventDefault(); openAdminConfirmModal(this, 'Hapus gambar galeri ini?')" style="position:absolute; top:-0.4rem; right:-0.4rem;">
                            @csrf @method('DELETE')
                            <button type="submit" style="width:1.25rem; height:1.25rem; border-radius:9999px; border:none; background:#ef4444; color:white; font-size:0.65rem; cursor:pointer;">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
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
                <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; margin-top:0.75rem;">
                    <input type="checkbox" name="is_published" value="1" {{ $project->is_published ? 'checked' : '' }}
                        style="width:1rem; height:1rem; accent-color:#22c55e;">
                    <span style="font-size:0.875rem; color:#94a3b8;">Publish project ke halaman publik</span>
                </label>
            </div>

            <div style="display:flex; gap:0.75rem;">
                <button type="submit" class="admin-btn admin-btn-primary">
                    <i class="fas fa-save"></i> Update Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-secondary">Batal</a>
                <a href="{{ route('admin.projects.preview', $project) }}" target="_blank" rel="noopener noreferrer" class="admin-btn admin-btn-secondary">
                    <i class="fas fa-eye"></i> Preview
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
