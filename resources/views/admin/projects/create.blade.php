@extends('admin.layout')
@section('title', 'Tambah Project')
@section('page-title', 'Tambah Project')
@section('page-subtitle', 'Buat project baru untuk portofolio')

@section('content')
<div style="width:100%;">
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
                    <label class="admin-label">Custom Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="admin-input" placeholder="poster-event-kampus">
                    @error('slug')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
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
                <div>
                    <label class="admin-label">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="admin-input" placeholder="0">
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

            <div style="margin-bottom:1rem; padding:1rem; border:1px solid rgba(255,255,255,0.06); border-radius:0.75rem; background:rgba(255,255,255,0.02);">
                <h3 style="font-size:0.95rem; font-weight:600; color:#f1f5f9; margin:0 0 1rem;">Konteks Project</h3>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                    <div>
                        <label class="admin-label">Status Project</label>
                        <select name="project_status" class="admin-input">
                            <option value="">Pilih status</option>
                            @foreach(['Learning Project', 'College Assignment', 'Personal Experiment', 'Portfolio Practice', 'Client/Freelance'] as $status)
                            <option value="{{ $status }}" {{ old('project_status') === $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="admin-label">Role Saya</label>
                        <input type="text" name="role" value="{{ old('role') }}" class="admin-input" placeholder="Contoh: UI Designer, Graphic Designer">
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div>
                        <label class="admin-label">Durasi</label>
                        <input type="text" name="duration" value="{{ old('duration') }}" class="admin-input" placeholder="Contoh: 2 minggu">
                    </div>
                    <div>
                        <label class="admin-label">Hasil / Insight</label>
                        <textarea name="impact" rows="2" class="admin-input" placeholder="Apa hasil atau pembelajaran dari project ini?">{{ old('impact') }}</textarea>
                    </div>
                </div>
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

            <div style="margin-bottom:1rem; padding:1rem; border:1px solid rgba(255,255,255,0.06); border-radius:0.75rem; background:rgba(255,255,255,0.02);">
                <h3 style="font-size:0.95rem; font-weight:600; color:#f1f5f9; margin:0 0 1rem;">SEO Project</h3>
                <div style="margin-bottom:1rem;">
                    <label class="admin-label">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title') }}" class="admin-input" placeholder="Judul khusus untuk Google/social preview">
                </div>
                <div style="margin-bottom:1rem;">
                    <label class="admin-label">SEO Description</label>
                    <textarea name="seo_description" rows="2" class="admin-input" maxlength="255" placeholder="Ringkasan singkat untuk hasil pencarian">{{ old('seo_description') }}</textarea>
                </div>
                <div>
                    <label class="admin-label">SEO Keywords</label>
                    <input type="text" name="seo_keywords" value="{{ old('seo_keywords') }}" class="admin-input" placeholder="portfolio, desain grafis, UI UX">
                    <p style="font-size:0.75rem; color:#475569; margin-top:0.25rem;">Pisahkan keyword dengan koma.</p>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Thumbnail Project</label>
                <input type="file" name="thumbnail" accept="image/*" class="admin-input" style="padding:0.5rem;">
                <p style="font-size:0.75rem; color:#475569; margin-top:0.25rem;">Format: JPG, PNG, WebP. Maks 2MB.</p>
            </div>

            <div style="margin-bottom:1rem;">
                <label class="admin-label">Open Graph Image</label>
                <input type="file" name="og_image" accept="image/*" class="admin-input" style="padding:0.5rem;">
                <p style="font-size:0.75rem; color:#475569; margin-top:0.25rem;">Gambar preview saat link dibagikan. Jika kosong, thumbnail dipakai.</p>
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
                <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; margin-top:0.75rem;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                        style="width:1rem; height:1rem; accent-color:#22c55e;">
                    <span style="font-size:0.875rem; color:#94a3b8;">Publish project ke halaman publik</span>
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
