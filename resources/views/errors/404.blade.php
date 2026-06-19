@extends('layouts.app')

@section('title', '404 — Halaman Tidak Ditemukan')

@section('content')
<div style="min-height:100vh; display:flex; align-items:center; justify-content:center; text-align:center; padding:2rem;">
    <div>
        <p class="gradient-text" style="font-size:8rem; font-weight:800; line-height:1; margin-bottom:1rem;">404</p>
        <h1 style="font-size:1.5rem; font-weight:700; color:#f1f5f9; margin-bottom:0.75rem;">Halaman Tidak Ditemukan</h1>
        <p style="color:#64748b; margin-bottom:2rem;">Halaman yang kamu cari tidak ada atau sudah dipindahkan.</p>
        <a href="{{ route('home') }}" class="btn-primary">
            <i class="fas fa-home" style="margin-right:0.5rem;"></i>Kembali ke Home
        </a>
    </div>
</div>
@endsection