<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Portofolio Wisnu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #0a0e1a; color: #e2e8f0; font-family: 'Inter', sans-serif; margin: 0; }
        .admin-sidebar {
            position: fixed; top: 0; left: 0; bottom: 0; width: 240px;
            background: #0f1628; border-right: 1px solid rgba(255,255,255,0.06);
            display: flex; flex-direction: column; z-index: 40;
        }
        .admin-main { margin-left: 240px; min-height: 100vh; padding: 2rem; }
        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.625rem 1.25rem; font-size: 0.875rem; font-weight: 500;
            color: #94a3b8; text-decoration: none; transition: all 0.2s;
            border-radius: 0.5rem; margin: 0.125rem 0.75rem;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: #22d3ee; background: rgba(6,182,212,0.1);
        }
        .sidebar-link i { width: 1.25rem; text-align: center; }
        .admin-card {
            background: #111827; border: 1px solid rgba(255,255,255,0.06);
            border-radius: 0.75rem; padding: 1.5rem;
        }
        .admin-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem;
            font-weight: 500; cursor: pointer; transition: all 0.2s; border: none;
            text-decoration: none;
        }
        .admin-btn-primary { background: linear-gradient(135deg,#06b6d4,#7c3aed); color: white; }
        .admin-btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }
        .admin-btn-danger { background: rgba(239,68,68,0.1); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
        .admin-btn-danger:hover { background: rgba(239,68,68,0.2); }
        .admin-btn-secondary { background: rgba(255,255,255,0.05); color: #94a3b8; border: 1px solid rgba(255,255,255,0.1); }
        .admin-btn-secondary:hover { background: rgba(255,255,255,0.1); color: #e2e8f0; }
        .admin-input {
            width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.5rem; padding: 0.625rem 0.875rem; color: #e2e8f0;
            font-size: 0.875rem; outline: none; transition: border-color 0.2s; box-sizing: border-box;
        }
        .admin-input:focus { border-color: rgba(6,182,212,0.5); }
        .admin-label { display: block; font-size: 0.875rem; color: #94a3b8; margin-bottom: 0.375rem; }
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th { padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .admin-table td { padding: 0.875rem 1rem; font-size: 0.875rem; border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle; }
        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }
        .badge { display: inline-block; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; }
        .badge-cyan { background: rgba(6,182,212,0.15); color: #22d3ee; }
        .badge-purple { background: rgba(124,58,237,0.15); color: #a78bfa; }
        .badge-green { background: rgba(34,197,94,0.15); color: #4ade80; }
        .badge-red { background: rgba(239,68,68,0.15); color: #f87171; }
        .alert-success { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2); color: #4ade80; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem; }
        ..alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #f87171; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem; }

        /* Fix dropdown select dark mode */
        select.admin-input {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
            cursor: pointer;
        }

        select.admin-input option {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
            padding: 0.5rem;
        }

        select.admin-input option:checked,
        select.admin-input option:hover {
            background-color: #0e7490 !important;
            color: white !important;
        }

        /* Fix semua input file */
        input[type="file"].admin-input {
            color: #94a3b8;
        }

        input[type="file"].admin-input::file-selector-button {
            background: rgba(6,182,212,0.1);
            border: 1px solid rgba(6,182,212,0.3);
            color: #22d3ee;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            font-size: 0.8rem;
            margin-right: 0.75rem;
            transition: all 0.2s;
        }

        input[type="file"].admin-input::file-selector-button:hover {
            background: rgba(6,182,212,0.2);
        }
    </style>
</head>
<body>

{{-- Sidebar --}}
<aside class="admin-sidebar">
    <div style="padding: 1.5rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.06);">
    @php $sidebarProfile = \App\Models\Profile::first(); @endphp

    {{-- Foto Profil --}}
    <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.75rem;">
        <div style="width:2.75rem; height:2.75rem; border-radius:0.75rem; overflow:hidden; flex-shrink:0; border:2px solid rgba(6,182,212,0.3);">
            @if($sidebarProfile && $sidebarProfile->photo)
                <img src="{{ Storage::url($sidebarProfile->photo) }}"
                     alt="{{ $sidebarProfile->name }}"
                     style="width:100%; height:100%; object-fit:cover;">
            @else
                <div style="width:100%; height:100%; background:linear-gradient(135deg,#06b6d4,#7c3aed); display:flex; align-items:center; justify-content:center; font-size:0.875rem; font-weight:700; color:white;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            @endif
        </div>
        <div style="min-width:0;">
            <span class="gradient-text" style="font-size:1rem; font-weight:700; display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                {{ $sidebarProfile->name ?? 'Wisnu Nugroho' }}
            </span>
            <p style="font-size:0.7rem; color:#64748b; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                {{ $sidebarProfile->title ?? 'Graphic Designer' }}
            </p>
        </div>
    </div>

    {{-- Label Dashboard --}}
    <div style="display:inline-flex; align-items:center; gap:0.375rem; padding:0.25rem 0.625rem; background:rgba(6,182,212,0.1); border:1px solid rgba(6,182,212,0.2); border-radius:9999px;">
        <span style="width:6px; height:6px; background:#22d3ee; border-radius:50%; display:inline-block;"></span>
        <span style="font-size:0.7rem; color:#22d3ee; font-weight:500;">Admin Dashboard</span>
    </div>
</div>

    <nav style="flex:1; padding: 0.75rem 0; overflow-y:auto;">
        <p style="font-size:0.65rem; color:#475569; text-transform:uppercase; letter-spacing:0.1em; padding:0.5rem 1.25rem; margin-bottom:0.25rem;">Menu</p>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-gauge"></i> Dashboard
        </a>
        <a href="{{ route('admin.projects.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="fas fa-folder"></i> Projects
        </a>
        <a href="{{ route('admin.skills.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
            <i class="fas fa-star"></i> Skills
        </a>
        <a href="{{ route('admin.experiences.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
            <i class="fas fa-clock"></i> Experience
        </a>
        <a href="{{ route('admin.messages.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Pesan
            @php $uncommented = \App\Models\Comment::whereNull('reply')->count(); @endphp
<a href="{{ route('admin.comments.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
    <i class="fas fa-comments"></i> Komentar
    @if($uncommented > 0)
    <span class="badge badge-cyan" style="margin-left:auto;">{{ $uncommented }}</span>
    @endif
</a>
            @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
            @if($unread > 0)
            <span class="badge badge-red" style="margin-left:auto;">{{ $unread }}</span>
            @endif
        </a>
        <a href="{{ route('admin.profile.edit') }}"
           class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <i class="fas fa-user"></i> Profil
        </a>

        <div style="border-top:1px solid rgba(255,255,255,0.06); margin:0.75rem; padding-top:0.75rem;">
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="fas fa-external-link-alt"></i> Lihat Website
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link" style="width:100%; background:none; border:none; cursor:pointer; text-align:left;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>
</aside>

{{-- Main Content --}}
<main class="admin-main">

    {{-- Top Bar --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:2rem;">
        <div>
            <h1 style="font-size:1.5rem; font-weight:700; color:#f1f5f9;">@yield('page-title', 'Dashboard')</h1>
            <p style="font-size:0.875rem; color:#64748b; margin-top:0.25rem;">@yield('page-subtitle', '')</p>
        </div>
        <div style="display:flex; align-items:center; gap:0.75rem;">
            <span style="font-size:0.875rem; color:#64748b;">{{ Auth::user()->name }}</span>
            @php $adminProfile = \App\Models\Profile::first(); @endphp
<div style="width:2rem; height:2rem; border-radius:50%; overflow:hidden; flex-shrink:0;">
    @if($adminProfile && $adminProfile->photo)
        <img src="{{ Storage::url($adminProfile->photo) }}"
             alt="{{ Auth::user()->name }}"
             style="width:100%; height:100%; object-fit:cover;">
    @else
        <div style="width:100%; height:100%; background:linear-gradient(135deg,#06b6d4,#7c3aed); display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:700; color:white;">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
    @endif
</div>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
    <div class="alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    @yield('content')
</main>

</body>
</html>