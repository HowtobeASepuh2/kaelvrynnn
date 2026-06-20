<div class="admin-card" style="max-width:56rem;">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" style="display:grid; gap:1rem;">
        @csrf
        @if($method === 'PUT') @method('PUT') @endif
        <div>
            <label class="admin-label">Judul</label>
            <input class="admin-input" name="title" value="{{ old('title', $article->title ?? '') }}" required>
            @error('title')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="admin-label">Slug Opsional</label>
            <input class="admin-input" name="slug" value="{{ old('slug', $article->slug ?? '') }}">
            @error('slug')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="admin-label">Ringkasan</label>
            <textarea class="admin-input" name="excerpt" rows="3">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
            @error('excerpt')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="admin-label">Isi</label>
            <textarea class="admin-input" name="body" rows="12" required>{{ old('body', $article->body ?? '') }}</textarea>
            @error('body')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="admin-label">Cover Image</label>
            <input type="file" class="admin-input" name="cover_image" accept="image/jpeg,image/png,image/webp">
            @error('cover_image')<p style="color:#f87171; font-size:0.75rem;">{{ $message }}</p>@enderror
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div>
                <label class="admin-label">SEO Title</label>
                <input class="admin-input" name="seo_title" value="{{ old('seo_title', $article->seo_title ?? '') }}">
            </div>
            <div>
                <label class="admin-label">SEO Description</label>
                <input class="admin-input" name="seo_description" value="{{ old('seo_description', $article->seo_description ?? '') }}">
            </div>
        </div>
        <label style="display:flex; align-items:center; gap:0.5rem; color:#cbd5e1;">
            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published ?? false) ? 'checked' : '' }}>
            Publish insight
        </label>
        <div style="display:flex; gap:0.75rem;">
            <button class="admin-btn admin-btn-primary">Simpan</button>
            <a href="{{ route('admin.articles.index') }}" class="admin-btn admin-btn-secondary">Batal</a>
        </div>
    </form>
</div>
