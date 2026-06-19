<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portofolio Wisnu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css'])
    <style>
        body { background:#0a0e1a; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; font-family:'Inter',sans-serif; }
    </style>
</head>
<body>
<div style="width:100%; max-width:400px; padding:1.5rem;">
    <div style="text-align:center; margin-bottom:2rem;">
        <span class="gradient-text" style="font-size:2rem; font-weight:700;">WN.</span>
        <p style="color:#64748b; font-size:0.875rem; margin-top:0.5rem;">Admin Dashboard</p>
    </div>

    <div class="glass-card" style="border-radius:1rem; padding:2rem;">
        <h2 style="font-size:1.25rem; font-weight:700; color:#f1f5f9; margin-bottom:1.5rem; text-align:center;">
            Masuk ke Dashboard
        </h2>

        @if($errors->any())
        <div style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.2); color:#f87171; padding:0.75rem 1rem; border-radius:0.5rem; margin-bottom:1rem; font-size:0.875rem;">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.875rem; color:#94a3b8; margin-bottom:0.375rem;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@portofolio.com" required
                    style="width:100%; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:0.5rem; padding:0.625rem 0.875rem; color:#e2e8f0; font-size:0.875rem; outline:none; box-sizing:border-box;">
            </div>
            <div style="margin-bottom:1.5rem;">
                <label style="display:block; font-size:0.875rem; color:#94a3b8; margin-bottom:0.375rem;">Password</label>
                <input type="password" name="password" placeholder="••••••••" required
                    style="width:100%; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:0.5rem; padding:0.625rem 0.875rem; color:#e2e8f0; font-size:0.875rem; outline:none; box-sizing:border-box;">
            </div>
            <button type="submit" class="btn-primary" style="width:100%; text-align:center; padding:0.75rem; font-size:0.875rem;">
                <i class="fas fa-sign-in-alt" style="margin-right:0.5rem;"></i>Masuk
            </button>
        </form>

        <p style="text-align:center; margin-top:1.5rem; font-size:0.8rem; color:#475569;">
            Default: admin@portofolio.com / admin123
        </p>
    </div>
</div>
</body>
</html>