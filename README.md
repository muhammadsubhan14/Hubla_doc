# Hubla Documentation

Website dokumentasi kegiatan berbasis album foto dengan Laravel Blade, Eloquent ORM, MySQL, dan Laravel Storage.

## Prasyarat

- PHP 8.2+, Composer, Node.js 18+
- XAMPP: Apache dan MySQL aktif
- Database MySQL `hubla_doc` sudah dibuat melalui phpMyAdmin

## Setup lokal

Pastikan `.env` memakai database yang sudah ada:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hubla_doc
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan:

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Buka `http://127.0.0.1:8000`. Laravel hanya membuat tabel melalui migration dan tidak membuat database baru.

## Admin

- URL: `http://127.0.0.1:8000/admin/login`
- Register admin: `http://127.0.0.1:8000/admin/register`
- Email: `admin@hubla.local`
- Password: `password`
- Kode registrasi lokal: `hubla-admin-register-2026`

Ganti password seed tersebut sebelum deployment production.
Kode registrasi admin disimpan di `ADMIN_REGISTRATION_KEY` pada `.env`; ganti nilainya sebelum deployment.

## Fitur utama

- Public gallery tanpa login dengan pagination dan detail kegiatan.
- Lightbox dengan caption, counter, previous/next, keyboard arrows, dan Escape.
- Admin dashboard, CRUD dokumentasi, CRUD PIC, dan pengelolaan foto.
- Upload multiple foto dengan validasi file dan hard limit 20 foto per dokumentasi, termasuk cover.
- Pemeriksaan kuota upload di backend dalam transaksi dengan row lock untuk mencegah race condition.
- Foto disimpan pada `storage/app/public`; database hanya menyimpan path.
