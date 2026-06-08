# QuestBoard

**Level Up Your Productivity**

QuestBoard adalah aplikasi produktivitas berbasis Laravel yang mengubah tugas harian menjadi quest bergaya RPG. User dapat membuat kategori guild, membuat quest, menentukan difficulty, deadline, status, mendapatkan EXP, naik level, dan bersaing di leaderboard.

UI saat ini diarahkan ke tema **premium dark fantasy RPG**: guild hall, quest board, mission journal, magical purple glow, dan aksen gold reward.

## Fitur Utama

- Authentication dari Laravel Breeze.
- Landing page cinematic dengan video background lokal.
- Dashboard `Guild Hall` berisi statistik quest, level, total EXP, dan progress level.
- CRUD quest lengkap.
- CRUD kategori guild lengkap.
- Category color picker dan emblem selector, jadi user tidak perlu mengetik kode warna.
- Quest search, filter, sorting, difficulty badge, status badge, dan overdue state.
- EXP otomatis berdasarkan difficulty.
- Level otomatis berdasarkan total EXP dari quest yang completed.
- Leaderboard `Hall of Heroes`.
- Profile upload photo.
- RPG profile picture template fallback.
- Avatar tampil di sidebar profile dan leaderboard.
- Responsive Blade + Tailwind CSS.
- Authorization agar user hanya mengelola quest dan kategori miliknya sendiri.

## Tech Stack

- PHP `^8.3`
- Laravel `13`
- Laravel Breeze
- Blade
- Tailwind CSS
- Alpine.js
- Vite
- MySQL
- Composer
- npm
- Laragon untuk local development

## Struktur Penting

```text
app/Http/Controllers      Controller aplikasi
app/Models                Model Eloquent
app/Support               Helper kecil, termasuk avatar template
database/migrations       Struktur database
database/seeders          Data demo
public/images             Gambar lokal
public/videos             Video background landing page
resources/css/app.css     Styling Tailwind custom
resources/views           Blade views dan components
routes/web.php            Route utama aplikasi
routes/auth.php           Route auth Breeze
```

## Setup Local Dengan Laragon

1. Nyalakan Laragon.

2. Start:

```text
Apache
MySQL
```

3. Buka terminal di folder Laragon `www`:

```bash
cd C:\laragon\www
```

4. Clone repository:

```bash
git clone https://github.com/Frizr/QuestBoard-Cloud.git QuestBoard
```

5. Masuk ke folder project:

```bash
cd QuestBoard
```

6. Install dependency PHP:

```bash
composer install
```

7. Install dependency frontend:

```bash
npm install
```

8. Buat file `.env` jika belum ada:

```bash
copy .env.example .env
```

Untuk Git Bash/Linux/macOS, gunakan:

```bash
cp .env.example .env
```

9. Generate app key:

```bash
php artisan key:generate
```

10. Buat database MySQL bernama:

```text
questboard
```

Jika database sudah ada dan muncul pesan seperti ini:

```text
Can't create database 'questboard'; database exists
```

Itu aman. Artinya database `questboard` sudah tersedia.

11. Pastikan konfigurasi database di `.env` seperti ini:

```env
APP_NAME=QuestBoard
APP_ENV=local
APP_DEBUG=true
APP_URL=http://questboard.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=questboard
DB_USERNAME=root
DB_PASSWORD=
```

12. Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

Kalau migration sebelumnya sudah pernah jalan dan muncul:

```text
INFO  Nothing to migrate.
```

Itu bukan masalah. Artinya struktur database sudah terbaru.

13. Buat storage link untuk foto profile:

```bash
php artisan storage:link
```

Jika muncul:

```text
The public/storage link already exists.
```

Itu aman. Artinya link storage sudah pernah dibuat.

## Cara Mengaktifkan Web

Buka dua terminal di folder project.

Terminal pertama untuk Vite:

```bash
npm run dev
```

Biarkan terminal ini tetap menyala.

Terminal kedua untuk Laravel:

```bash
php artisan serve
```

Buka browser:

```text
http://127.0.0.1:8000
```

Jika memakai Laragon virtual host, bisa juga buka:

```text
http://questboard.test
```

Catatan: saat `npm run dev` muncul tulisan seperti ini:

```text
[vite] (client) [optimizer] bundling dependencies...
```

Itu normal. Biasanya hanya proses Vite menyiapkan dependency.

## Cara Pakai Aplikasi

1. Buka halaman utama QuestBoard.

2. Pilih:

```text
Start Your Journey
```

untuk register, atau:

```text
Enter Guild Hall
```

untuk login.

3. Login dengan akun demo jika sudah menjalankan seeder:

```text
Email: demo@questboard.test
Password: password
```

4. Masuk ke `Guild Hall`.

Di halaman ini user bisa melihat:

- level adventurer
- total EXP
- progress EXP
- total quest
- pending quest
- in progress quest
- completed quest
- overdue quest
- recent activity
- upcoming deadlines

5. Buat kategori di `Guild Categories`.

Kategori dipakai sebagai divisi guild, misalnya:

- Work
- Study
- Project
- Health
- Personal

Saat membuat kategori:

- isi nama kategori
- pilih warna dari color picker
- pilih emblem/logo guild
- simpan

User tidak perlu mengetik kode warna secara manual.

6. Buat quest di `Quest Log`.

Klik:

```text
Post Quest
```

Isi:

- title
- description
- category
- difficulty
- status
- deadline

Reward EXP dihitung otomatis dari difficulty.

7. Update status quest.

Jika quest diubah menjadi:

```text
completed
```

maka EXP user akan bertambah dan level akan dihitung ulang.

8. Buka detail quest.

Detail quest tampil seperti mission briefing, berisi:

- title
- description
- category
- difficulty
- status
- deadline
- reward EXP
- completed date jika sudah selesai

9. Cek leaderboard di `Hall of Heroes`.

Leaderboard menampilkan:

- rank
- adventurer name
- profile avatar
- level
- EXP
- completed quests

Email user tidak ditampilkan di leaderboard.

10. Edit profile di `Adventurer Profile`.

Di profile user bisa:

- update nama
- update email
- upload profile photo
- pilih RPG portrait template
- hapus uploaded photo dan kembali ke template
- update password
- delete account

Jika foto upload tidak muncul, pastikan sudah menjalankan:

```bash
php artisan storage:link
```

## Akses Database Lewat phpMyAdmin

Pastikan Apache dan MySQL di Laragon sudah menyala.

Buka:

```text
http://localhost/phpmyadmin
```

Login default Laragon:

```text
Username: root
Password: kosongkan
```

Pilih database:

```text
questboard
```

Tabel penting:

- `users`
- `categories`
- `quests`
- `sessions`
- `cache`
- `jobs`
- `migrations`

## Database

Tabel `users` menyimpan:

- name
- email
- password
- total_exp
- level
- avatar_path
- avatar_template

Tabel `categories` menyimpan:

- user_id
- name
- color
- emblem

Tabel `quests` menyimpan:

- user_id
- category_id
- title
- description
- difficulty
- status
- reward_exp
- deadline
- completed_at

## Video Background

Landing page memakai video background lokal dari:

```text
public/videos/questboard-bg.mp4
public/videos/questboard-bg.webm
public/videos/questboard-bg.svg
```

Aturan:

- Video background hanya untuk landing page hero.
- Optional untuk login/register.
- Jangan dipakai di dashboard, quest CRUD, category CRUD, atau leaderboard.
- Pakai overlay gelap agar teks tetap terbaca.
- Jika video tidak tersedia, pakai fallback gradient atau SVG.

## Profile Picture

Profile picture punya dua mode:

1. Uploaded photo
2. RPG portrait template

Uploaded photo disimpan di:

```text
storage/app/public/avatars
```

Browser mengaksesnya lewat:

```text
public/storage
```

Karena itu perlu:

```bash
php artisan storage:link
```

Template avatar saat ini diatur dari:

```text
app/Support/AvatarTemplates.php
resources/views/components/avatar-portrait.blade.php
resources/views/components/adventurer-avatar.blade.php
```

Catatan: profile picture template masih perlu diperbagus agar lebih premium RPG/tabletop fantasy.

## Stitch Design Reference

Folder ini hanya dipakai sebagai referensi visual:

```text
stitch_questboard_dark_fantasy_redesign
```

Jangan copy HTML static secara langsung. Desain harus dikonversi menjadi Blade + Tailwind yang tetap memakai logic Laravel.

## Useful Commands

Jalankan test:

```bash
php artisan test
```

Build frontend:

```bash
npm run build
```

Clear cache:

```bash
php artisan optimize:clear
```

Compile Blade untuk cek error:

```bash
php artisan view:cache
php artisan view:clear
```

Refresh database local dengan seeder:

```bash
php artisan migrate:fresh --seed
```

Hati-hati: command ini menghapus semua data local lalu membuat ulang database.

## Troubleshooting

### `database exists`

Jika saat membuat database muncul:

```text
database exists
```

Artinya database sudah ada. Lanjut ke migration.

### `Nothing to migrate`

Artinya migration sudah pernah dijalankan. Ini normal.

### `public/storage link already exists`

Artinya storage link sudah ada. Ini normal.

### Foto profile tidak tampil

Jalankan:

```bash
php artisan storage:link
```

Jika link sudah ada tapi tetap tidak tampil:

```bash
php artisan storage:unlink
php artisan storage:link
```

### phpMyAdmin meminta install Composer

Biasanya phpMyAdmin Laragon belum lengkap atau dependency-nya belum terinstall. Kalau phpMyAdmin sudah bisa dibuka, tidak perlu menjalankan `composer update` lagi di folder phpMyAdmin.

Jika Composer error `ext-zip` saat mengurus phpMyAdmin, aktifkan extension `zip` di `php.ini` Laragon.

### Vite port `5173`

`npm run dev` memang menjalankan Vite di:

```text
http://localhost:5173
```

Tetap buka aplikasi Laravel dari:

```text
http://127.0.0.1:8000
```

atau:

```text
http://questboard.test
```

## Deployment Notes

Untuk production/AWS EC2:

```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Apache/Nginx harus diarahkan ke:

```text
public
```

Folder yang perlu writable:

```text
storage
bootstrap/cache
```

## Memory Prompt

Untuk melanjutkan pengembangan UI/UX, baca:

```text
QUESTBOARD_MEMORY_PROMPT.md
```

File itu berisi arahan desain, kekurangan yang masih perlu diperbaiki, aturan asset profile picture, dan prompt lanjutan untuk Codex/AI.
