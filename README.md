# KOCHI Helpdesk — Sistem Tiketing Realtime

Aplikasi helpdesk berbasis web untuk mengelola laporan masalah (tiket) antara **karyawan** dan **admin/teknisi**.
Data tampil **realtime tanpa refresh** lewat WebSocket, dilengkapi pencarian langsung (live search), dashboard statistik, dan laporan Excel.

> Ganti `USERNAME/NAMA-REPO` pada contoh perintah di bawah dengan alamat repository kamu.

## Daftar Isi

- [Fitur](#fitur)
- [Teknologi](#teknologi)
- [Cara Kerja Realtime](#cara-kerja-realtime)
- [Instalasi dengan Docker (Disarankan)](#instalasi-dengan-docker-disarankan)
- [Instalasi Tanpa Docker (XAMPP)](#instalasi-tanpa-docker-xampp)
- [Konfigurasi `.env`](#konfigurasi-env)
- [Membuat Akun Admin Pertama](#membuat-akun-admin-pertama)
- [Mengakses dari Luar (ngrok / Hosting)](#mengakses-dari-luar-ngrok--hosting)
- [Halaman Utama](#halaman-utama)
- [Alur Status Tiket](#alur-status-tiket)
- [Event WebSocket](#event-websocket)
- [Troubleshooting](#troubleshooting)
- [Keamanan Sebelum Deploy](#keamanan-sebelum-deploy)
- [Struktur Folder](#struktur-folder)

---

## Fitur

**Karyawan**
- Membuat tiket dengan subjek, kategori, deskripsi, dan lampiran gambar (JPG/PNG/WEBP, maks. 5 MB).
- Validasi dilakukan server terlebih dahulu, baru konfirmasi SweetAlert muncul.
- Gambar besar (misalnya screenshot) otomatis dikecilkan di browser sebelum dikirim.
- Maksimal **5 tiket per hari** per pengguna.
- Memantau status dan teknisi tiket secara realtime.
- Live search dan pagination pada daftar tiket sendiri.

**Admin**
- Dashboard statistik (bar chart bulanan, pie chart per kategori) dengan filter bulan dan tahun tanpa reload.
- Mengelola tiket: ubah status, tugaskan teknisi, lihat detail dan lampiran.
- Mengelola kategori dan pengguna (tambah, ubah, hapus) dengan validasi duplikasi.
- Hapus **cascade**: menghapus kategori atau pengguna ikut menghapus tiket, aktivitas, lampiran, dan file gambar terkait.
- Riwayat aktivitas dengan filter dan **export ke Excel** sesuai filter yang aktif.
- Notifikasi email ke admin saat ada tiket baru.

**Umum**
- Realtime via WebSocket (tiket baru, perubahan status, perubahan kategori dan user).
- Live search dengan debounce dan pagination yang mengikuti kata kunci.
- Role-based access (`admin` dan `karyawan`).

## Teknologi

| Bagian | Teknologi |
|---|---|
| Backend | PHP 8.2, CodeIgniter 4.7 |
| Database | MySQL 8.0 |
| Realtime | Ratchet 0.4 (WebSocket) dan ReactPHP Socket |
| Laporan | PhpSpreadsheet |
| Frontend | Bootstrap 5, Chart.js, SweetAlert2, JavaScript |
| Infrastruktur | Docker Compose (Nginx, PHP-FPM, MySQL, phpMyAdmin) |

## Cara Kerja Realtime

`websocket.php` berjalan sebagai proses terpisah yang terus hidup, sehingga CI4 tidak bisa memanggilnya langsung.
CI4 mengirim sinyal ke port internal, lalu server menyebarkannya ke semua browser yang terhubung.

```
Browser ──(wss://domain/ws/)──► Nginx ──► websocket:8081 ◄── (broadcast ke semua browser)
                                                ▲
CI4 (PHP-FPM) ── BroadcastTrait ── TCP ─────────┘ websocket:8090 (internal, tidak dibuka ke publik)
```

Browser memakai alamat yang dibuat otomatis dari domain yang sedang dibuka (`window.WS_URL`, lihat template layout), sehingga
jalan di `localhost`, ngrok, maupun domain sungguhan tanpa mengubah kode.

## Instalasi dengan Docker (Disarankan)

**Prasyarat:** Docker Desktop (Windows/Mac) atau Docker Engine + Compose (Linux). Port `8080`, `8081`, `8082`, `3306` harus bebas.
Matikan MySQL XAMPP jika sedang berjalan, karena memakai port 3306.

```bash
# 1. Ambil kode
git clone https://github.com/USERNAME/NAMA-REPO.git
cd NAMA-REPO

# 2. Siapkan konfigurasi
cp .env.example .env            # Windows (CMD): copy .env.example .env

# 3. Install dependency PHP ke folder project
#    (wajib: folder project di-mount ke container, jadi vendor/ harus ada di host)
docker compose run --rm --no-deps php composer install --no-dev --optimize-autoloader

# 4. Jalankan semua service
docker compose up -d --build

# 5. Cek semua container berstatus Up
docker compose ps
```

Linux/Mac saja: beri izin tulis pada folder yang dipakai aplikasi.
```bash
chmod -R 777 writable public/img
```

Database dibuat otomatis saat container MySQL **pertama kali** start, dari file `.sql` di `docker/mysql/init/`.
Jika kamu mengubah isi file itu lalu ingin menjalankannya ulang:
```bash
docker compose down -v      # PERINGATAN: menghapus seluruh data database
docker compose up -d
```

Setelah selesai:

| Layanan | Alamat |
|---|---|
| Aplikasi | http://localhost:8080 |
| phpMyAdmin | http://localhost:8082 |
| WebSocket (via Nginx) | `ws://localhost:8080/ws/` |

Perintah yang sering dipakai:
```bash
docker compose logs -f websocket     # lihat log server realtime
docker compose logs -f php           # lihat log aplikasi
docker compose stop                  # hentikan (data aman)
docker compose start                 # nyalakan lagi
docker compose down                  # hapus container (data database tetap ada)
```

## Instalasi Tanpa Docker (XAMPP)

Hanya jika tidak memakai Docker. Kebutuhan: PHP 8.2+ dengan ekstensi `intl`, `mysqli`, `gd`, `zip`, `mbstring`; MySQL; Composer.

```bash
composer install
cp .env.example .env
```

1. Buat database `database_kochi` di phpMyAdmin dan import `docker/mysql/init/schema.sql`.
2. Ubah di `.env`: `database.default.hostname = localhost` dan `app.baseURL = 'http://localhost:8080/'`.
3. Jalankan di dua terminal berbeda:
   ```bash
   php spark serve --port 8080
   php websocket.php
   ```
4. **Penting:** tanpa Nginx, alamat `/ws/` tidak ada. Di template layout (`app/Views/template/templateAdmin.php` dan `templateUser.php`),
   ganti alamat WebSocket menjadi langsung ke port 8081:
   ```javascript
   window.WS_URL = 'ws://localhost:8081';
   ```

## Konfigurasi `.env`

Salin dari `.env.example`. File `.env` **tidak boleh** masuk ke Git.

| Variabel | Keterangan |
|---|---|
| `CI_ENVIRONMENT` | `development` saat belajar, **`production`** saat dipublikasikan |
| `app.baseURL` | Alamat aplikasi, akhiri dengan `/` |
| `database.default.*` | Koneksi database. Di Docker, hostname = `mysql` |
| `email.*` | SMTP untuk notifikasi. Gmail wajib memakai **App Password**, bukan password akun |

Variabel `WEBSOCKET_HOST` dan `WEBSOCKET_PUSH_PORT` diatur di `docker-compose.yml` (bagian service `php`).
Tanpa Docker, bawaannya `127.0.0.1:8090`.

## Membuat Akun Admin Pertama

Halaman registrasi selalu membuat akun berperan `karyawan`. Untuk admin pertama:

1. Daftar lewat halaman `/register`.
2. Naikkan perannya lewat database:
   ```bash
   docker exec -it ticket_mysql mysql -uroot -proot database_kochi \
     -e "UPDATE users SET role='admin' WHERE email='email-kamu@contoh.com';"
   ```
3. Login ulang. Admin diarahkan ke `/dashboard`.

## Mengakses dari Luar (ngrok / Hosting)

**ngrok** (cukup satu tunnel, karena WebSocket lewat Nginx di port yang sama):
```bash
ngrok http 8080
```
Lalu ubah `app.baseURL` di `.env` menjadi alamat ngrok (akhiri dengan `/`) dan `docker compose restart php`.
Domain ngrok versi gratis berubah setiap restart, jadi `baseURL` perlu diperbarui lagi.

**Hosting:** harus **VPS** (bukan shared hosting/cPanel), karena `websocket.php` harus berjalan terus sebagai proses background.
Gunakan HTTPS (Let's Encrypt). Alamat `wss://` otomatis dipakai oleh `window.WS_URL`.
Port 8081 dan 8090 **jangan** dibuka ke publik; cukup 80 dan 443.

## Halaman Utama

| Alamat | Peran | Fungsi |
|---|---|---|
| `/login`, `/register` | Publik | Masuk dan daftar |
| `/dashboard` | Admin | Statistik dan grafik |
| `/ticket`, `/ticket/detail/{id}` | Admin | Kelola tiket |
| `/kategory` | Admin | Kelola kategori |
| `/users`, `/usersK` | Admin | Kelola pengguna (admin dan karyawan) |
| `/aktivitas`, `/aktivitas/export` | Admin | Riwayat aktivitas dan export Excel |
| `/lihat`, `/user/detail/{id}` | Karyawan | Daftar dan detail tiket sendiri |

## Alur Status Tiket

```
Buka ─► Ditugaskan ─► Dikerja ─► Selesai ─► Tutup
```

- Tiket berstatus `Tutup` tetap tampil di daftar admin selama 1 minggu setelah ditutup.
- Pencarian membaca seluruh data, termasuk tiket yang sudah lewat 1 minggu.

## Event WebSocket

| Event | Dikirim saat | Dipakai oleh |
|---|---|---|
| `new_ticket` | Tiket dibuat | Daftar tiket, dashboard, aktivitas |
| `status_update` | Status atau teknisi berubah | Daftar tiket, detail, dashboard, aktivitas |
| `new_category` / `update_category` / `delete_category` | Kategori berubah | Kategori, daftar tiket, dashboard |
| `new_user` / `user_updated` / `delete_user` / `role_update` | Pengguna berubah | Halaman pengguna |

## Troubleshooting

| Gejala | Penyebab dan solusi |
|---|---|
| `vendor/autoload.php` tidak ditemukan | Langkah 3 instalasi belum dijalankan (`composer install` di host) |
| MySQL gagal start: port 3306 dipakai | Matikan MySQL XAMPP, atau ubah ke `"3307:3306"` di `docker-compose.yml` |
| Error `mysqli not loaded` | Rebuild image: `docker compose build php --no-cache` |
| WebSocket tidak terhubung | Cek `docker compose logs -f websocket`. Pastikan `window.WS_URL` terdefinisi di template layout |
| Tidak realtime saat disimpan | Pastikan `WEBSOCKET_HOST=websocket` ada di service `php` pada `docker-compose.yml` |
| `413 Request Entity Too Large` | Naikkan `client_max_body_size` di `docker/nginx/default.conf` |
| Upload gambar selalu ditolak | Cek `upload_max_filesize` dan `post_max_size` PHP, lalu `docker compose restart php nginx` |
| `Unexpected token '<' ... is not valid JSON` | Server membalas HTML, bukan JSON. Buka `F12 → Network → Response` pada request tersebut |
| Perubahan `.env` tidak terbaca | `docker compose restart php websocket` |
| Database tidak terbuat ulang | Init SQL hanya jalan di start pertama. Gunakan `docker compose down -v` |

## Keamanan Sebelum Deploy

- Ganti password database `root/root` dengan password yang kuat, dan samakan di semua tempat yang memakainya.
- Jangan membuka port `3306` (MySQL) dan `8082` (phpMyAdmin) ke publik; hapus bagian `ports` keduanya di `docker-compose.yml`.
- Set `CI_ENVIRONMENT = production`.
- Jangan pernah mengunggah `.env` atau App Password ke Git. Jika pernah terunggah, **cabut dan buat ulang** kuncinya.
- Alamat email notifikasi tiket sebaiknya dipindah dari kode ke `.env` agar tidak tertulis di repository.

## Struktur Folder

```
app/
├── Controllers/      Cadmin (aksi tulis), CTadmin (halaman & pencarian admin),
│                     Ckaryawan, Clogin
├── Models/           users, tickets, categories, aktivitas, attachments
├── Libraries/        TicketServer.php  (handler WebSocket)
├── Traits/           BroadcastTrait.php (kirim sinyal ke server WebSocket)
├── Filters/          Login, Admin, User
└── Views/            admin/, user/, auth/, template/
docker/
├── php/Dockerfile
├── websocket/Dockerfile
├── nginx/default.conf
└── mysql/init/       schema.sql (dijalankan otomatis saat MySQL pertama start)
public/img/           Lampiran tiket (tidak masuk Git, kecuali default.jpg)
websocket.php         Entry point server realtime
docker-compose.yml
```

## Lisensi

Dibangun di atas [CodeIgniter 4](https://codeigniter.com) (MIT). Lihat berkas `LICENSE`.
