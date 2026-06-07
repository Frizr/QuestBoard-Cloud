# QuestBoard - Level Up Your Productivity

## 1. Deskripsi Project

QuestBoard adalah aplikasi web task management berbasis gamification RPG. Aplikasi ini mengubah pekerjaan harian menjadi quest yang dapat dipantau berdasarkan status, difficulty, due date, dan reward EXP.

Project ini dibuat sebagai Tugas Besar Mata Kuliah Komputasi Awan dan Virtualisasi. Aplikasi dikembangkan menggunakan Laravel, Laravel Breeze, Tailwind CSS, Vite, dan database SQLite untuk environment lokal. Untuk deployment ke AWS EC2, database dapat tetap menggunakan SQLite atau dikonfigurasi ulang ke MySQL/MariaDB jika diperlukan.

---

## 2. Tujuan Project

Tujuan dari QuestBoard adalah:

1. Membuat aplikasi task management berbasis web.
2. Mengimplementasikan konsep gamification menggunakan quest, difficulty, EXP, dan level.
3. Menyediakan autentikasi user menggunakan Laravel Breeze.
4. Menyimpan data user dan quest ke database lokal.
5. Menjalankan aplikasi Laravel pada environment lokal menggunakan Laragon.
6. Menyiapkan project agar dapat di-deploy ke AWS EC2.

---

## 3. Teknologi yang Digunakan

| Komponen                 | Teknologi                      |
| ------------------------ | ------------------------------ |
| Framework backend        | Laravel 13                     |
| Authentication           | Laravel Breeze                 |
| Frontend                 | Blade, Tailwind CSS, Alpine.js |
| Build tool               | Vite                           |
| Database lokal           | SQLite                         |
| Runtime lokal            | Laragon PHP 8.3                |
| Package manager PHP      | Composer                       |
| Package manager frontend | npm                            |

Catatan database:

- Project saat ini menggunakan SQLite melalui file `database/database.sqlite`.
- Karena menggunakan SQLite, database tidak dibuka melalui phpMyAdmin.
- Untuk melihat isi database secara visual, gunakan DB Browser for SQLite.
- MySQL Laragon boleh menyala, tetapi tidak dipakai selama `.env` masih memakai `DB_CONNECTION=sqlite`.

---

## 4. Struktur Implementasi

Struktur utama project:

```text
QuestBoard/
├── app/
│   ├── Http/Controllers/
│   │   ├── TaskController.php
│   │   └── ProfileController.php
│   └── Models/
│       ├── User.php
│       └── Task.php
├── database/
│   ├── database.sqlite
│   └── migrations/
│       ├── 0001_01_01_000000_create_users_table.php
│       ├── 0001_01_01_000001_create_cache_table.php
│       ├── 0001_01_01_000002_create_jobs_table.php
│       └── 2026_06_07_000001_create_tasks_table.php
├── resources/
│   ├── css/app.css
│   ├── js/app.js
│   └── views/
│       ├── welcome.blade.php
│       ├── dashboard.blade.php
│       ├── layouts/
│       └── auth/
├── routes/
│   ├── web.php
│   └── auth.php
└── public/
    ├── images/questboard-hero.png
    └── build/
```

---

## 5. Fitur yang Sudah Diimplementasikan

### 5.1 Landing Page

Landing page sudah diganti dari halaman bawaan Laravel menjadi halaman QuestBoard dengan tema dark RPG productivity.

Elemen landing page:

- Hero section dengan background visual mission board.
- Judul utama: `Turn every task into a quest worth finishing.`
- Deskripsi singkat aplikasi.
- CTA untuk register, login, atau masuk ke dashboard.
- Visual direction: dark background, purple primary color, gold accent color, dan nuansa RPG mission board.

File terkait:

```text
resources/views/welcome.blade.php
public/images/questboard-hero.png
```

---

### 5.2 Authentication

Authentication menggunakan Laravel Breeze.

Fitur auth yang tersedia:

- Register user.
- Login user.
- Logout user.
- Forgot password view.
- Reset password route.
- Profile edit.
- Proteksi halaman dashboard menggunakan middleware `auth` dan `verified`.

Route auth berada di:

```text
routes/auth.php
```

Redirect setelah login/register diarahkan ke:

```text
/dashboard
```

---

### 5.3 Dashboard User

Dashboard sudah dibuat sebagai RPG mission board.

Dashboard menampilkan:

- Total quest.
- Active quest.
- Completed quest.
- Quest due soon.
- Total EXP.
- Level user.
- Progress bar menuju level berikutnya.
- Kanban board berdasarkan status.
- Quest ledger table.

File terkait:

```text
resources/views/dashboard.blade.php
app/Http/Controllers/TaskController.php
```

---

### 5.4 Quest Management

User dapat mengelola quest/task miliknya sendiri.

Fitur quest yang sudah ada:

- Tambah quest.
- Edit quest.
- Hapus quest.
- Ubah status quest.
- Ubah difficulty.
- Tambah due date.
- Melihat quest dalam board dan table.

Data quest yang tersimpan:

| Field         | Keterangan                |
| ------------- | ------------------------- |
| `user_id`     | Relasi quest ke user      |
| `title`       | Judul quest               |
| `description` | Deskripsi quest           |
| `status`      | Status quest              |
| `priority`    | Difficulty/priority quest |
| `due_date`    | Tanggal deadline          |
| `created_at`  | Waktu pembuatan           |
| `updated_at`  | Waktu update              |

File terkait:

```text
app/Models/Task.php
app/Http/Controllers/TaskController.php
database/migrations/2026_06_07_000001_create_tasks_table.php
```

---

### 5.5 Difficulty System

Difficulty diimplementasikan menggunakan field `priority`.

| Priority | Label UI | Reward EXP |
| -------- | -------- | ---------: |
| `low`    | Common   |     40 EXP |
| `medium` | Rare     |     80 EXP |
| `high`   | Epic     |    120 EXP |

Reward EXP saat ini dihitung untuk tampilan dashboard berdasarkan quest yang statusnya `done`.

---

### 5.6 Status Quest

Status quest yang digunakan:

| Status Database | Label UI    | Keterangan              |
| --------------- | ----------- | ----------------------- |
| `todo`          | To do       | Quest belum dikerjakan  |
| `in_progress`   | In progress | Quest sedang dikerjakan |
| `done`          | Done        | Quest selesai           |

Status divisualisasikan dengan badge warna berbeda di quest card dan quest ledger.

---

### 5.7 EXP dan Leveling System

EXP dihitung dari quest yang sudah selesai (`status = done`).

Reward EXP:

```text
low    = 40 EXP
medium = 80 EXP
high   = 120 EXP
```

Formula level yang digunakan di dashboard:

```text
level = floor(total_exp / 500) + 1
```

Progress menuju level berikutnya:

```text
current_level_exp = total_exp % 500
level_progress = (current_level_exp / 500) * 100
```

Implementasi perhitungan berada di:

```text
app/Http/Controllers/TaskController.php
```

---

### 5.8 Authorization Data User

Setiap quest hanya dapat diakses oleh pemiliknya.

Implementasi:

- Query dashboard hanya mengambil quest dari user yang sedang login.
- Update dan delete task melakukan pengecekan `user_id`.
- Jika user mencoba mengubah task milik user lain, aplikasi mengembalikan response `403 Forbidden`.

Potongan logic utama:

```php
abort_unless($task->user_id === $request->user()->id, 403);
```

---

## 6. Database

### 6.1 Database yang Digunakan Saat Ini

Project saat ini menggunakan SQLite.

Konfigurasi `.env`:

```env
DB_CONNECTION=sqlite
```

File database:

```text
database/database.sqlite
```

Tabel yang sudah ada:

| Tabel        | Fungsi                                              |
| ------------ | --------------------------------------------------- |
| `users`      | Menyimpan akun user                                 |
| `tasks`      | Menyimpan quest/task user                           |
| `cache`      | Cache Laravel                                       |
| `jobs`       | Queue Laravel                                       |
| `sessions`   | Session user jika session driver database digunakan |
| `migrations` | Riwayat migrasi Laravel                             |

Status terakhir yang sudah dicek:

```text
users: 2
tasks: 0
migrations: 4
```

Artinya database sudah aktif, user sudah tersimpan, tetapi belum ada quest/task yang dibuat dari dashboard.

---

### 6.2 Cara Membuka Database SQLite

Karena project memakai SQLite, database tidak dibuka melalui phpMyAdmin.

Gunakan aplikasi:

```text
DB Browser for SQLite
```

Langkah:

1. Buka DB Browser for SQLite.
2. Pilih `Open Database`.
3. Pilih file:

```text
D:\Aku(rizal)\Telkom University Surabaya\Semester 6\Komputasi Awan\Tubes\QuestBoard\database\database.sqlite
```

4. Masuk tab `Browse Data`.
5. Pilih tabel `users`, `tasks`, atau `migrations`.

---

### 6.3 Catatan MySQL dan phpMyAdmin

phpMyAdmin hanya untuk MySQL/MariaDB.

Saat ini QuestBoard tidak memakai MySQL karena `.env` masih menggunakan SQLite.

Jika ingin menggunakan MySQL, konfigurasi `.env` perlu diubah, database MySQL perlu dibuat, lalu migration dijalankan ulang. Namun untuk kondisi implementasi saat ini, SQLite sudah cukup untuk development lokal.

---

## 7. Route Utama

Route utama berada di:

```text
routes/web.php
```

Daftar route penting:

| Method | URL             | Controller/View          | Keterangan     |
| ------ | --------------- | ------------------------ | -------------- |
| GET    | `/`             | `welcome`                | Landing page   |
| GET    | `/dashboard`    | `TaskController@index`   | Dashboard user |
| POST   | `/tasks`        | `TaskController@store`   | Tambah quest   |
| PATCH  | `/tasks/{task}` | `TaskController@update`  | Update quest   |
| DELETE | `/tasks/{task}` | `TaskController@destroy` | Hapus quest    |
| GET    | `/profile`      | `ProfileController@edit` | Edit profile   |
| POST   | `/logout`       | Auth controller          | Logout         |

---

## 8. UI Design

UI sudah diperbaiki dengan gaya dark RPG productivity web app.

Karakter desain:

- Dark background.
- Purple sebagai warna utama.
- Gold/amber sebagai warna aksen.
- Card-based layout.
- RPG mission board feeling.
- Badge status dan difficulty.
- Smooth hover effects.
- Responsive untuk mobile dan desktop.

Komponen UI utama:

- Landing hero section.
- Dashboard stat cards.
- Level progress bar.
- Quest form.
- Quest kanban cards.
- Quest ledger table.
- Responsive navigation.

---

## 9. Validasi CRUD

Validasi task dilakukan di `TaskController`.

Validasi saat membuat quest:

```php
$title       = required, string, max:120
$description = nullable, string, max:1000
$status      = required, in:todo,in_progress,done
$priority    = required, in:low,medium,high
$due_date    = nullable, date
```

Validasi saat update quest menggunakan rule yang sama, tetapi beberapa field bersifat `sometimes`.

---

## 10. Testing

Test suite sudah dijalankan dan berhasil.

Command:

```bash
php artisan test
```

Hasil terakhir:

```text
28 passed
```

Test yang relevan:

- Auth test dari Laravel Breeze.
- Profile test.
- Task creation test.
- Authorization test agar user tidak dapat mengubah task milik user lain.
- Dashboard render test.

---

## 11. Cara Menjalankan di Laragon

Pastikan Laragon menyala minimal untuk PHP/terminal environment. Apache dan MySQL boleh menyala, tetapi MySQL tidak wajib karena project memakai SQLite.

Masuk ke folder project:

```bash
cd "D:\Aku(rizal)\Telkom University Surabaya\Semester 6\Komputasi Awan\Tubes\QuestBoard"
```

Install dependency PHP jika belum ada:

```bash
composer install
```

Install dependency frontend:

```bash
npm install --ignore-scripts
```

Generate app key jika belum ada:

```bash
php artisan key:generate
```

Jalankan migration:

```bash
php artisan migrate
```

Build asset frontend:

```bash
npm run build
```

Jalankan server lokal:

```bash
php artisan serve --host=127.0.0.1 --port=8088
```

Buka di browser:

```text
http://127.0.0.1:8088
```

---

## 12. Command Sebelum Deploy ke AWS EC2

Command yang dijalankan di local sebelum upload/deploy:

```bash
composer install --no-dev --optimize-autoloader
npm install --ignore-scripts
npm run build
php artisan test
```

Pastikan `.env` production tidak ikut dipush ke repository publik.

---

## 13. Command Umum di AWS EC2

Setelah project berada di EC2:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Jika memakai SQLite di EC2, pastikan file database ada dan permission folder benar:

```bash
touch database/database.sqlite
chmod -R 775 storage bootstrap/cache database
```

Jika memakai MySQL di EC2, buat database MySQL terlebih dahulu, ubah konfigurasi `.env`, lalu jalankan:

```bash
php artisan migrate --force
```

---

## 14. Status Implementasi Saat Ini

| Fitur                         | Status                  |
| ----------------------------- | ----------------------- |
| Laravel project               | Selesai                 |
| Laravel Breeze authentication | Selesai                 |
| Landing page custom           | Selesai                 |
| Dark RPG UI                   | Selesai                 |
| Dashboard user                | Selesai                 |
| Quest CRUD                    | Selesai                 |
| Status badge                  | Selesai                 |
| Difficulty badge              | Selesai                 |
| EXP display                   | Selesai                 |
| Level progress bar            | Selesai                 |
| Authorization user data       | Selesai                 |
| SQLite database               | Selesai                 |
| Category management           | Belum diimplementasikan |
| Search/filter quest           | Belum diimplementasikan |
| Leaderboard global            | Belum diimplementasikan |
| MySQL/phpMyAdmin integration  | Belum digunakan         |

---

## 15. Kesimpulan

QuestBoard sudah dapat dijalankan secara lokal menggunakan Laragon dan Laravel development server. Aplikasi sudah memiliki landing page, authentication, dashboard RPG, quest CRUD, badge status/difficulty, EXP calculation, level progress bar, dan penyimpanan data menggunakan SQLite.

Untuk development lokal saat ini, database tersimpan di file `database/database.sqlite`. Karena itu, database dibuka menggunakan DB Browser for SQLite, bukan phpMyAdmin.
