<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="EpxdVnoMagYQoXNjaLKTKdFTlZ98fcehcmzmpsWl9r8" />

    {{-- Dynamic Title --}}
    <title>@yield('title', 'Wisnu Nugroho | UI/UX Designer & Creative Editor')</title>

    {{-- Dynamic Meta --}}
    <meta name="description" content="@yield('meta_description', 'Portofolio pribadi Wisnu Nugroho, mahasiswa Sistem Informasi yang berfokus pada desain grafis, UI/UX, content design, dan video editing.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Wisnu Nugroho, UI/UX Designer, Creative Editor, UI/UX, Desain Grafis, Portofolio, Jambi')">
    <meta name="author" content="Wisnu Nugroho">
    <meta name="robots" content="index, follow">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', 'Wisnu Nugroho | UI/UX Designer & Creative Editor')">
    <meta property="og:description" content="@yield('meta_description', 'Portofolio pribadi Wisnu Nugroho')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:site_name" content="Portofolio Wisnu Nugroho">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Wisnu Nugroho | UI/UX Designer & Creative Editor')">
    <meta name="twitter:description" content="@yield('meta_description', 'Portofolio pribadi Wisnu Nugroho')">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Structured Data --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $profile->name ?? 'Wisnu Nugroho',
            'jobTitle' => $profile->title ?? 'UI/UX Designer & Creative Editor',
            'url' => url('/'),
            'email' => $profile->email ?? null,
            'sameAs' => array_values(array_filter([
                $profile->instagram ?? null,
                $profile->github ?? null,
                $profile->linkedin ?? null,
            ])),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.12/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-[#0a0e1a] text-slate-200 grid-pattern">

    {{-- Page Loader --}}
    <div id="page-loader" class="page-loader">
        <div style="text-align:center;">
            <span class="gradient-text" style="font-size:2rem; font-weight:700; display:block; margin-bottom:1rem;">WN.</span>
            <div style="display:flex; gap:0.5rem; justify-content:center;">
                <div style="width:8px; height:8px; background:#06b6d4; border-radius:50%; animation:bounce 0.8s infinite;"></div>
                <div style="width:8px; height:8px; background:#7c3aed; border-radius:50%; animation:bounce 0.8s infinite 0.2s;"></div>
                <div style="width:8px; height:8px; background:#06b6d4; border-radius:50%; animation:bounce 0.8s infinite 0.4s;"></div>
            </div>
        </div>
    </div>

    <style>
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Back to Top Button --}}
<button
    id="back-to-top"
    onclick="window.scrollTo({top:0, behavior:'smooth'})"
    style="
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 2.5rem;
        height: 2.5rem;
        background: linear-gradient(135deg, #06b6d4, #7c3aed);
        color: white;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 40;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(6,182,212,0.3);
    "
    aria-label="Kembali ke atas"
>
    <i class="fas fa-chevron-up" style="font-size:0.875rem;"></i>
</button>

    @stack('scripts')

    <script>
        // Page loader
        window.addEventListener('load', function () {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 400);
            }
        });

        // Back to top
        window.addEventListener('scroll', function () {
            const btn = document.getElementById('back-to-top');
            if (btn) {
                btn.style.display = window.scrollY > 400 ? 'flex' : 'none';
            }
        });
    </script>

</body>
</html>


