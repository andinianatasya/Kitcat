KITCAT (Kitty Interaction Through Coding And Training)

Nama Kelompok: Power Girls
- Andini Anatasya (231401002)
- Clara Angelin Pijoh (231401086)
- Fadiyah Maisyarah (231401101)
- Tiara Bella Dwiyanti Sitepu (231401107)

## Deskripsi Proyek
Permainan berbasis website merawat kucing dari bayi hingga dewasa dengan minigame coding

## Cara Menjalankan Proyek

### Prerequisites
- PHP 7.4 atau lebih baru
- Web server (Apache/Nginx)
- Browser modern (Chrome, Firefox, Safari, Edge)
- Node.js (untuk Tailwind CSS compilation)

### Langkah-Langkah Instalasi dan Menjalankan

1. **Clone atau download repository ini**
   ```bash
   git clone <repository-url>
   cd Kitcat
   ```

2. **Install dependencies Node.js**
   ```bash
   npm install
   ```

3. **Build Tailwind CSS**
   ```bash
   npm run build
   ```

4. **Setup Web Server**
   - Pastikan folder proyek berada di root web server (htdocs untuk Apache)
   - Akses aplikasi melalui browser: `http://localhost/Kitcat/publik/beranda.html`

5. **Jalankan Aplikasi**
   - Navigasi ke halaman login di: `http://localhost/Kitcat/publik/login.html`
   - Buat akun baru atau login dengan akun yang sudah ada
   - Mulai bermain dan merawat kucing Anda!

### Struktur Proyek
- `publik/` - File publik (HTML, PHP, CSS, JavaScript)
- `src/` - File sumber (CSS input untuk Tailwind)
- `package.json` - Konfigurasi npm dan dependencies
