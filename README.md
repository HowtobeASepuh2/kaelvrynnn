# Portofolio Wisnu Nugroho

Aplikasi portofolio berbasis Laravel untuk menampilkan profil, skill, pengalaman, project, insight/artikel, testimoni/komentar, dan form kontak dengan panel admin sederhana.

## Fitur

- Halaman publik: home, about, skills, experience, projects, services, insights, contact.
- Admin CRUD: profile, skills, experience, project categories, projects, articles, comments, dan contact messages.
- Upload gambar otomatis dikonversi ke WebP untuk optimasi performa.
- Komentar publik masuk sebagai pending approval.
- Contact form dan comment form memakai honeypot serta rate limiting.
- SEO dasar: meta tag dinamis, Open Graph, canonical URL, JSON-LD, dan sitemap XML.
- Analytics sederhana untuk view project, klik demo, dan download CV.

## Stack

- PHP 8.2+
- Laravel 12
- SQLite/MySQL compatible
- Vite
- Tailwind CSS
- Alpine.js
- Intervention Image

## Setup Lokal

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run build
```

Jalankan server lokal:

```bash
php artisan serve
```

Untuk mode development asset:

```bash
npm run dev
```

## Akun Admin

Seeder admin membaca nilai dari `.env`:

```env
ADMIN_NAME="Administrator"
ADMIN_EMAIL="admin@example.com"
ADMIN_PASSWORD="change-this-password"
```

Ganti nilai tersebut sebelum menjalankan `php artisan migrate --seed`, terutama untuk deployment.

## Testing

```bash
composer test
```

## Catatan Deploy

- Pastikan `APP_ENV=production`, `APP_DEBUG=false`, dan `APP_URL` sesuai domain.
- Jalankan `php artisan storage:link` agar file upload publik bisa diakses.
- Gunakan password admin yang kuat dan unik.
- Jalankan `php artisan config:cache` dan `php artisan route:cache` setelah konfigurasi final.
