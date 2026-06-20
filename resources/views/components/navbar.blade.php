<nav id="navbar" style="position:fixed; top:0; left:0; right:0; z-index:50; transition: all 0.3s ease;">
    <div style="max-width:72rem; margin:0 auto; padding:0 1.5rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; height:4rem;">

            {{-- Logo --}}
            @php $navProfile = \App\Models\Profile::first(); @endphp
<a href="{{ route('home') }}" style="text-decoration:none; display:flex; align-items:center; gap:0.625rem;">
    {{-- Foto kecil di navbar --}}
    <div style="width:2rem; height:2rem; border-radius:0.5rem; overflow:hidden; border:1px solid rgba(6,182,212,0.3); flex-shrink:0;">
        @if($navProfile && $navProfile->photo)
            <img src="{{ Storage::url($navProfile->photo) }}"
                 alt="{{ $navProfile->name }}"
                 style="width:100%; height:100%; object-fit:cover;">
        @else
            <div style="width:100%; height:100%; background:linear-gradient(135deg,#06b6d4,#7c3aed); display:flex; align-items:center; justify-content:center; font-size:0.7rem; font-weight:700; color:white;">
                WN
            </div>
        @endif
    </div>
    <span class="gradient-text" style="font-size:1.25rem; font-weight:700;">Wisnu Nugroho</span>
</a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex" style="align-items:center; gap:2rem;">
                <a href="{{ route('home') }}"
                   style="text-decoration:none; font-size:0.875rem; font-weight:500;"
                   class="{{ request()->routeIs('home') ? 'text-cyan-400' : 'text-slate-300 hover:text-cyan-400' }} transition-colors">
                    Home
                </a>
                <a href="{{ route('about') }}"
                   style="text-decoration:none; font-size:0.875rem; font-weight:500;"
                   class="{{ request()->routeIs('about') ? 'text-cyan-400' : 'text-slate-300 hover:text-cyan-400' }} transition-colors">
                    About
                </a>
                <a href="{{ route('skills') }}"
                   style="text-decoration:none; font-size:0.875rem; font-weight:500;"
                   class="{{ request()->routeIs('skills') ? 'text-cyan-400' : 'text-slate-300 hover:text-cyan-400' }} transition-colors">
                    Skills
                </a>
                <a href="{{ route('projects.index') }}"
                   style="text-decoration:none; font-size:0.875rem; font-weight:500;"
                   class="{{ request()->routeIs('projects.index') ? 'text-cyan-400' : 'text-slate-300 hover:text-cyan-400' }} transition-colors">
                    Projects
                </a>
                <a href="{{ route('experience') }}"
                   style="text-decoration:none; font-size:0.875rem; font-weight:500;"
                   class="{{ request()->routeIs('experience') ? 'text-cyan-400' : 'text-slate-300 hover:text-cyan-400' }} transition-colors">
                    Experience
                </a>
                <a href="{{ route('services') }}"
                   style="text-decoration:none; font-size:0.875rem; font-weight:500;"
                   class="{{ request()->routeIs('services') ? 'text-cyan-400' : 'text-slate-300 hover:text-cyan-400' }} transition-colors">
                    Services
                </a>
                <a href="{{ route('contact') }}"
                   style="text-decoration:none; font-size:0.875rem; font-weight:500;"
                   class="{{ request()->routeIs('contact') ? 'text-cyan-400' : 'text-slate-300 hover:text-cyan-400' }} transition-colors">
                    Contact
                </a>
            </div>

            {{-- CTA Button --}}
            <div class="hidden md:block">
                <a href="{{ route('contact') }}" class="btn-primary" style="font-size:0.875rem; padding:0.5rem 1.25rem;">
                    Hire Me
                </a>
            </div>

            {{-- Hamburger --}}
            <button id="menu-toggle" class="md:hidden"
                style="background:none; border:none; cursor:pointer; padding:0.5rem; color:#cbd5e1;">
                <i id="icon-open" class="fas fa-bars" style="font-size:1.25rem;"></i>
                <i id="icon-close" class="fas fa-times" style="font-size:1.25rem; display:none;"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" style="display:none; background:#0f1628; border-top:1px solid rgba(255,255,255,0.05);">
        <div style="padding:1rem 1.5rem; display:flex; flex-direction:column; gap:0.25rem;">
            <a href="{{ route('home') }}" class="nav-mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-house" style="width:1rem;"></i> Home
            </a>
            <a href="{{ route('about') }}" class="nav-mobile-link {{ request()->routeIs('about') ? 'active' : '' }}">
                <i class="fas fa-user" style="width:1rem;"></i> About
            </a>
            <a href="{{ route('skills') }}" class="nav-mobile-link {{ request()->routeIs('skills') ? 'active' : '' }}">
                <i class="fas fa-star" style="width:1rem;"></i> Skills
            </a>
            <a href="{{ route('projects.index') }}" class="nav-mobile-link {{ request()->routeIs('projects.index') ? 'active' : '' }}">
                <i class="fas fa-folder" style="width:1rem;"></i> Projects
            </a>
            <a href="{{ route('experience') }}" class="nav-mobile-link {{ request()->routeIs('experience') ? 'active' : '' }}">
                <i class="fas fa-clock" style="width:1rem;"></i> Experience
            </a>
            <a href="{{ route('services') }}" class="nav-mobile-link {{ request()->routeIs('services') ? 'active' : '' }}">
                <i class="fas fa-briefcase" style="width:1rem;"></i> Services
            </a>
            <a href="{{ route('contact') }}" class="nav-mobile-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                <i class="fas fa-envelope" style="width:1rem;"></i> Contact
            </a>
            <div style="padding-top:0.75rem; border-top:1px solid rgba(255,255,255,0.05); margin-top:0.5rem;">
                <a href="{{ route('contact') }}" class="btn-primary" style="display:block; text-align:center; font-size:0.875rem;">
                    Hire Me
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
.nav-mobile-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.625rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #cbd5e1;
    text-decoration: none;
    transition: all 0.2s;
}
.nav-mobile-link:hover,
.nav-mobile-link.active {
    color: #22d3ee;
    background: rgba(6, 182, 212, 0.1);
}
</style>

<script>
    // Scroll effect
    window.addEventListener('scroll', function () {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(10, 14, 26, 0.95)';
            navbar.style.backdropFilter = 'blur(12px)';
            navbar.style.borderBottom = '1px solid rgba(255,255,255,0.05)';
            navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.3)';
        } else {
            navbar.style.background = 'transparent';
            navbar.style.backdropFilter = 'none';
            navbar.style.borderBottom = 'none';
            navbar.style.boxShadow = 'none';
        }
    });

    // Mobile toggle
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const menu     = document.getElementById('mobile-menu');
        const iconOpen  = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');
        const isHidden  = menu.style.display === 'none';

        menu.style.display  = isHidden ? 'block' : 'none';
        iconOpen.style.display  = isHidden ? 'none'  : 'inline';
        iconClose.style.display = isHidden ? 'inline' : 'none';
    });
</script>