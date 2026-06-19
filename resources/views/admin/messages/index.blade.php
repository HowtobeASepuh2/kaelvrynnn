@extends('admin.layout')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('page-subtitle', 'Pesan dari form kontak website')

@section('content')
<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr><th>Pengirim</th><th>Subjek</th><th>Pesan</th><th>Waktu</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
            <tr style="{{ !$msg->is_read ? 'background:rgba(6,182,212,0.03)' : '' }}">
                <td>
                    <p style="font-weight:500; color:#e2e8f0;">{{ $msg->name }}</p>
                    <p style="font-size:0.75rem; color:#64748b;">{{ $msg->email }}</p>
                </td>
                <td style="color:#94a3b8; font-size:0.875rem;">{{ $msg->subject }}</td>
                <td style="color:#94a3b8; font-size:0.8rem; max-width:250px;">{{ Str::limit($msg->message, 80) }}</td>
                <td style="color:#64748b; font-size:0.8rem; white-space:nowrap;">{{ $msg->created_at->format('d M Y H:i') }}</td>
                <td>
                    @if($msg->is_read)
                    <span class="badge badge-green">Dibaca</span>
                    @else
                    <span class="badge badge-red">Baru</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex; gap:0.5rem;">
                        @if(!$msg->is_read)
                        <form action="{{ route('admin.messages.read', $msg->id) }}" method="POST">
                            @csrf @method('PUT')
                            <button type="submit" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem; font-size:0.8rem;">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-btn admin-btn-danger" style="padding:0.375rem 0.75rem; font-size:0.8rem;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center; color:#64748b; padding:2rem;">Belum ada pesan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection