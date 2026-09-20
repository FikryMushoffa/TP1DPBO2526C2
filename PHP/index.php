<?php
// Mengimpor definisi class Film agar objek Film dapat dikenali oleh PHP
require_once __DIR__ . "/Film.php";

// Memulai sesi PHP untuk menyimpan array data film secara sementara di memori server
session_start();         

// Inisialisasi array 'daftarFilm' di dalam session jika belum pernah dibuat sebelumnya
if (!isset($_SESSION['daftarFilm'])) {
    $_SESSION['daftarFilm'] = [];
}

/**
 * Mencari posisi indeks array film berdasarkan ID film.
 * Menggunakan strcasecmp agar pencarian bersifat case-insensitive (tidak peka huruf besar/kecil).
 */
function findIndexById(string $idFilm): int {
    // Melakukan perulangan pada seluruh objek film yang tersimpan di session
    foreach ($_SESSION['daftarFilm'] as $index => $film) {
        // Membandingkan ID film target dengan ID film di dalam array
        if (strcasecmp($film->getIdFilm(), $idFilm) === 0) {
            return $index; // Mengembalikan posisi indeks jika ID cocok
        }
    }
    return -1; // Mengembalikan -1 jika ID film tidak ditemukan
}

/**
 * Mengelola proses unggah (upload) file gambar poster ke direktori lokal 'images/'.
 */
function uploadGambar(array $file): string {
    // Menentukan folder tujuan penyimpanan file gambar poster
    $targetDir = "images/";

    // Membuat direktori 'images/' secara otomatis jika folder tersebut belum ada di server
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Memeriksa apakah ada file yang diunggah dan tidak mengalami eror saat diunggah
    if (!empty($file["name"]) && $file["error"] === 0) {
        // Membuat nama file unik menggunakan timestamp agar file dengan nama sama tidak menimpa
        $fileName = time() . "_" . basename($file["name"]);
        $targetFilePath = $targetDir . $fileName;
        
        // Mengambil ekstensi file gambar dan mengubahnya menjadi huruf kecil
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Daftar format ekstensi gambar yang diperbolehkan untuk diunggah
        $allowTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        // Validasi apakah ekstensi file termasuk dalam daftar ekstensi yang diizinkan
        if (in_array($fileType, $allowTypes)) {
            // Memindahkan file dari direktori sementara (tmp) ke folder tujuan
            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                return $targetFilePath; // Mengembalikan path lengkap lokasi gambar
            }
        }
    }
    return ""; // Mengembalikan string kosong jika unggah gagal atau tidak ada file
}

// Variabel penampung teks pesan notifikasi dan tipe statusnya (success/error)
$message = "";
$messageType = "";

// PEMROSESAN AKSI FORM (POST REQUEST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mengambil parameter jenis aksi dari form POST
    $action = $_POST['action'] ?? '';

    //  AKSI 1: TAMBAH DATA FILM BARU 
    if ($action === 'tambah') {
        // Mengambil data dari form dan membersihkan karakter spasi di awal/akhir
        $idFilm = trim($_POST['idFilm'] ?? '');
        $judul = trim($_POST['judul'] ?? '');
        $genre = trim($_POST['genre'] ?? '');
        $durasi = (int)($_POST['durasiMenit'] ?? 0);
        $rating = (float)($_POST['rating'] ?? 0.0);

        // Validasi input: Kolom wajib diisi
        if (empty($idFilm) || empty($judul) || empty($genre)) {
            $message = "[ERROR] Input data film tidak boleh kosong!";
            $messageType = "error";
        // Validasi input: ID Film harus unik (belum pernah dipakai)
        } elseif (findIndexById($idFilm) !== -1) {
            $message = "[ERROR] ID Film sudah digunakan! Silakan gunakan ID lain.";
            $messageType = "error";
        // Validasi input: Durasi harus bilangan positif
        } elseif ($durasi <= 0) {
            $message = "[ERROR] Durasi film harus berupa angka positif (lebih dari 0)!";
            $messageType = "error";
        // Validasi input: Rentang angka rating harus 0.0 - 10.0
        } elseif ($rating < 0.0 || $rating > 10.0) {
            $message = "[ERROR] Nilai rating harus berada di rentang 0.0 sampai 10.0!";
            $messageType = "error";
        } else {
            // Memproses unggah file poster gambar
            $gambar = uploadGambar($_FILES['gambar'] ?? []);
            
            // Membuat instansi objek Film baru dan memasukkannya ke dalam array session
            $_SESSION['daftarFilm'][] = new Film($idFilm, $judul, $genre, $durasi, $rating, $gambar);
            $message = "[SUCCESS] Film baru berhasil ditambahkan ke katalog!";
            $messageType = "success";
        }
    }

    //  AKSI 2: PERBARUI / UPDATE DATA FILM 
    if ($action === 'update') {
        $targetId = trim($_POST['targetId'] ?? '');
        $idx = findIndexById($targetId);

        // Memeriksa ketersediaan data film yang akan diperbarui
        if ($idx === -1) {
            $message = "[ERROR] Data film dengan ID '{$targetId}' tidak ditemukan!";
            $messageType = "error";
        } else {
            $filmLama = $_SESSION['daftarFilm'][$idx];
            
            // Ambil data baru dari form, jika kosong tetap gunakan data lama
            $idBaru = trim($_POST['idFilm'] ?? $filmLama->getIdFilm());
            $judulBaru = trim($_POST['judul'] ?? $filmLama->getJudul());
            $genreBaru = trim($_POST['genre'] ?? $filmLama->getGenre());
            $durasiBaru = (int)($_POST['durasiMenit'] ?? $filmLama->getDurasiMenit());
            $ratingBaru = (float)($_POST['rating'] ?? $filmLama->getRating());

            // Validasi jika pengguna mengubah ID film ke ID lain yang sudah ada
            if (strcasecmp($idBaru, $filmLama->getIdFilm()) !== 0 && findIndexById($idBaru) !== -1) {
                $message = "[ERROR] ID Film baru sudah digunakan oleh film lain!";
                $messageType = "error";
            } elseif ($durasiBaru <= 0) {
                $message = "[ERROR] Durasi film harus bernilai positif!";
                $messageType = "error";
            } elseif ($ratingBaru < 0.0 || $ratingBaru > 10.0) {
                $message = "[ERROR] Rating film harus berada di rentang 0.0 - 10.0!";
                $messageType = "error";
            } else {
                // Memperbarui atribut objek film menggunakan setter
                $filmLama->setIdFilm($idBaru);
                $filmLama->setJudul($judulBaru);
                $filmLama->setGenre($genreBaru);
                $filmLama->setDurasiMenit($durasiBaru);
                $filmLama->setRating($ratingBaru);

            // Ganti gambar lama jika ada gambar baru yang diunggah
            if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] === 0) {
                $gambarBaru = uploadGambar($_FILES['gambar']);
                if (!empty($gambarBaru)) {
                    // HAPUS FILE GAMBAR LAMA DARI FOLDER SERVER
                    $gambarLama = $filmLama->getGambar();
                    if (!empty($gambarLama) && file_exists($gambarLama)) {
                        unlink($gambarLama); // Menghapus file fisik gambar lama
                    }

                    // Set path gambar baru ke objek
                    $filmLama->setGambar($gambarBaru);
                }
            }

                $message = "[SUCCESS] Data film berhasil diperbarui!";
                $messageType = "success";
            }
        }
    }

    //  AKSI 3: HAPUS DATA FILM 
    if ($action === 'hapus') {
        $targetId = trim($_POST['idFilm'] ?? '');
        $idx = findIndexById($targetId);
    
        // Hapus objek dari array jika ID ditemukan
        if ($idx !== -1) {
            $filmTarget = $_SESSION['daftarFilm'][$idx];
    
            // HAPUS FILE GAMBAR FISIK DARI FOLDER SERVER
            $gambarTarget = $filmTarget->getGambar();
            if (!empty($gambarTarget) && file_exists($gambarTarget)) {
                unlink($gambarTarget); // Menghapus file gambar dari folder images/
            }
    
            // Potong dan hapus elemen objek pada indeks terkait di session
            array_splice($_SESSION['daftarFilm'], $idx, 1); 
            $message = "[SUCCESS] Film dengan ID '{$targetId}' berhasil dihapus!";
            $messageType = "success";
        } else {
            $message = "[ERROR] Film dengan ID '{$targetId}' tidak ditemukan!";
            $messageType = "error";
        }
    }
}

// PEMROSESAN NAVIGASI & CARI (GET REQUEST)

// Pemrosesan fitur pencarian film berdasarkan ID
$searchResult = null;
$searchId = trim($_GET['searchId'] ?? '');
if (!empty($searchId)) {
    $idx = findIndexById($searchId);
    if ($idx !== -1) {
        $searchResult = $_SESSION['daftarFilm'][$idx]; // Menyimpan objek film hasil pencarian
    } else {
        $message = "[ERROR] Film dengan ID '{$searchId}' tidak ditemukan!";
        $messageType = "error";
    }
}

// Pemrosesan pengambilan data film yang akan diisi ke form edit
$editFilm = null;
$editId = trim($_GET['editId'] ?? '');
if (!empty($editId)) {
    $idx = findIndexById($editId);
    if ($idx !== -1) {
        $editFilm = $_SESSION['daftarFilm'][$idx]; // Menyimpan objek film target untuk di-edit
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Data Film - Cinema Platform</title>
    <style>
        /*  RESET DEFAULT MARGIN & PADDING BROWSER  */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /*  TEMA UTAMA: DARK CINEMA MODE  */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f172a; /* Warna latar belakang sangat gelap */
            color: #f8fafc; /* Teks berwarna terang agar kontras */
            min-height: 100vh;
            padding: 30px 20px;
        }

        /*  KONTAINER UTAMA PEMBATAS LEBAR KONTEN  */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /*  STYLING HEADER & JUDUL APLIKASI  */
        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-size: 2.3em;
            color: #38bdf8; /* Warna aksen biru terang sinematik */
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 0.95em;
            color: #94a3b8;
        }

        /*  STYLING PANEL CARD UNTUK FORM & MODUL  */
        .card {
            background: #1e293b; /* Warna latar kartu abu-abu gelap kebiruan */
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        .card h2 {
            color: #f1f5f9;
            font-size: 1.3em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #334155;
        }

        /*  STYLING TATA LETAK GRID POSTER FILM (KATALOG MODERN)  */
        .film-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); /* Penataan grid responsif */
            gap: 25px;
            margin-top: 20px;
        }

        /*  STYLING KARTU FILM INDIVIDUAL  */
        .film-card {
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /*  EFEK HOVER PADA KARTU FILM  */
        .film-card:hover {
            transform: translateY(-8px); /* Efek terangkat ke atas saat diarahkan kursor */
            box-shadow: 0 12px 30px rgba(56, 189, 248, 0.25);
        }

        /*  PEMBUNGKUS POSTER DENGAN RASIO STANDAR BIOSKOP (2:3)  */
        .poster-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 2 / 3; /* Memastikan poster berasio 2:3 dan tidak gepeng */
            background: #1e293b;
            overflow: hidden;
        }

        /*  GAMBAR POSTER DI DALAM KARTU  */
        .film-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Menyesuaikan poster penuh tanpa merusak proporsi */
            transition: transform 0.3s ease;
        }

        /*  EFEK ZOOM GAMBAR POSTER SAAT HOVER  */
        .film-card:hover .film-card-img {
            transform: scale(1.06);
        }

        /*  TAMPILAN PENGGANTI JIKA GAMBAR POSTER KOSONG  */
        .film-card-no-img {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-weight: 600;
            font-size: 0.85em;
            background: #1e293b;
        }

        /*  LENCANA RATING MELAYANG DI ATAS POSTER  */
        .rating-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(15, 23, 42, 0.85); /* Latar belakang kaca transparan */
            color: #fbbf24; /* Warna bintang emas */
            font-weight: 700;
            font-size: 0.85em;
            padding: 4px 10px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        /*  AREA INFORMASI TEKS KARTU FILM  */
        .film-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: space-between;
        }

        .film-card-body h3 {
            color: #f8fafc;
            font-size: 1.1em;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; /* Mengatur judul panjang agar berubah jadi titik-titik (...) */
        }

        .film-card-body p {
            color: #94a3b8;
            font-size: 0.85em;
            margin-bottom: 4px;
        }

        /*  LABEL GENRE FILM  */
        .genre-tag {
            display: inline-block;
            background: #0284c7;
            color: #ffffff;
            font-size: 0.75em;
            padding: 3px 8px;
            border-radius: 6px;
            margin-bottom: 8px;
            width: fit-content;
        }

        /*  DETAIL PENCARIAN FILM  */
        .film-detail {
            display: flex;
            gap: 25px;
            align-items: flex-start;
            margin-top: 15px;
            background: #0f172a;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #334155;
        }

        .film-detail .poster-wrapper-detail {
            width: 220px;
            aspect-ratio: 2 / 3;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .film-detail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .film-info h3 {
            font-size: 1.6em;
            color: #f8fafc;
            margin-bottom: 8px;
        }

        .film-info p {
            font-size: 0.95em;
            color: #cbd5e1;
            margin-bottom: 8px;
        }

        /*  STYLING FORM & INPUT DATA  */
        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            color: #cbd5e1;
            font-weight: 600;
            font-size: 0.9em;
            margin-bottom: 6px;
            display: block;
        }

        .form-group input, .search-box input {
            background: #0f172a;
            border: 1px solid #334155;
            color: #f8fafc;
            padding: 10px 14px;
            border-radius: 8px;
            width: 100%;
            font-size: 0.95em;
        }

        .form-group input:focus, .search-box input:focus {
            outline: none;
            border-color: #38bdf8;
        }

        /*  STYLING TOMBOL OPERASI (BUTTONS)  */
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9em;
            transition: opacity 0.2s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-green { background: #16a34a; color: white; }
        .btn-blue { background: #0284c7; color: white; }
        .btn-yellow { background: #d97706; color: white; }
        .btn-red { background: #dc2626; color: white; }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 12px;
        }

        /*  STYLING PESAN NOTIFIKASI SYSTEM  */
        .message {
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 0.95em;
        }
        .message.success { background: #064e3b; color: #6ee7b7; border: 1px solid #047857; }
        .message.error { background: #7f1d1d; color: #fca5a5; border: 1px solid #b91c1c; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Utama Aplikasi -->
        <div class="header">
            <h1>🎬 SISTEM MANAJEMEN DATA FILM</h1>
            <p>Katalog & Pengelolaan Data Film Bergaya Platform Streaming</p>
        </div>

        <!-- Menampilkan Pesan Status Operasi Jika Ada (Sukses/Error) -->
        <?php if (!empty($message)): ?>
            <div class="message <?= $messageType ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Form Tambah/Edit Data Film -->
        <div class="card">
            <h2><?= $editFilm ? "EDIT DATA FILM" : "TAMBAH DATA FILM BARU" ?></h2>
            <form method="POST" enctype="multipart/form-data">
                <!-- Input Tersembunyi: Menentukan jenis aksi POST (tambah/update) -->
                <input type="hidden" name="action" value="<?= $editFilm ? 'update' : 'tambah' ?>">
                
                <!-- Input Tersembunyi: Menampung ID target asli jika dalam mode edit -->
                <?php if ($editFilm): ?>
                    <input type="hidden" name="targetId" value="<?= htmlspecialchars($editFilm->getIdFilm()) ?>">
                <?php endif; ?>

                <div class="form-row">
                    <!-- Input ID Film -->
                    <div class="form-group">
                        <label>ID Film</label>
                        <input type="text" name="idFilm" value="<?= $editFilm ? htmlspecialchars($editFilm->getIdFilm()) : '' ?>" placeholder="Contoh: F001" required>
                    </div>
                    <!-- Input Judul Film -->
                    <div class="form-group">
                        <label>Judul Film</label>
                        <input type="text" name="judul" value="<?= $editFilm ? htmlspecialchars($editFilm->getJudul()) : '' ?>" placeholder="Contoh: Interstellar" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Input Genre Film -->
                    <div class="form-group">
                        <label>Genre Film</label>
                        <input type="text" name="genre" value="<?= $editFilm ? htmlspecialchars($editFilm->getGenre()) : '' ?>" placeholder="Contoh: Sci-Fi, Adventure" required>
                    </div>
                    <!-- Input Durasi Film -->
                    <div class="form-group">
                        <label>Durasi (Menit)</label>
                        <input type="number" name="durasiMenit" value="<?= $editFilm ? $editFilm->getDurasiMenit() : '' ?>" placeholder="Contoh: 169" required>
                    </div>
                    <!-- Input Rating Film -->
                    <div class="form-group">
                        <label>Rating Film (0.0 - 10.0)</label>
                        <input type="number" step="0.1" name="rating" value="<?= $editFilm ? $editFilm->getRating() : '' ?>" placeholder="Contoh: 8.7" required>
                    </div>
                </div>

                <!-- Input File Unggahan Gambar Poster -->
                <div class="form-group">
                    <label>Poster Gambar (File Lokal)</label>
                    <input type="file" name="gambar" accept="image/*">
                    <?php if ($editFilm && $editFilm->getGambar()): ?>
                        <p style="font-size: 12px; margin-top: 5px; color:#94a3b8;">Poster saat ini: <code><?= htmlspecialchars($editFilm->getGambar()) ?></code></p>
                    <?php endif; ?>
                </div>

                <!-- Tombol Submit Form -->
                <button type="submit" class="btn <?= $editFilm ? 'btn-yellow' : 'btn-green' ?>">
                    <?= $editFilm ? "Simpan Perubahan" : "Tambah Film" ?>
                </button>

                <!-- Tombol Batal Saat Berada pada Mode Edit -->
                <?php if ($editFilm): ?>
                    <a href="index.php" class="btn btn-blue">Batal</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Modul Pencarian Film -->
        <div class="card">
            <h2>CARI DATA FILM</h2>
            <form method="GET" class="search-box" style="display:flex; gap:10px;">
                <!-- Input Teks Pencarian ID Film -->
                <input type="text" name="searchId" placeholder="Masukkan ID Film..." value="<?= htmlspecialchars($searchId) ?>" required>
                <button type="submit" class="btn btn-blue">Cari</button>
                <!-- Tombol Reset Hasil Pencarian -->
                <?php if (!empty($searchId)): ?>
                    <a href="index.php" class="btn btn-red">Reset</a>
                <?php endif; ?>
            </form>

            <!-- Menampilkan Detail Hasil Pencarian Jika Data Ditemukan -->
            <?php if ($searchResult): ?>
                <div class="film-detail">
                    <!-- Area Poster Film Target -->
                    <div class="poster-wrapper-detail">
                        <?php if ($searchResult->getGambar()): ?>
                            <img src="<?= htmlspecialchars($searchResult->getGambar()) ?>" alt="Poster Film">
                        <?php else: ?>
                            <div class="film-card-no-img">Tidak Ada Poster</div>
                        <?php endif; ?>
                    </div>

                    <!-- Informasi Rinci Film Hasil Pencarian -->
                    <div class="film-info">
                        <h3><?= htmlspecialchars($searchResult->getJudul()) ?></h3>
                        <span class="genre-tag"><?= htmlspecialchars($searchResult->getGenre()) ?></span>
                        <p><strong>ID Film:</strong> <?= htmlspecialchars($searchResult->getIdFilm()) ?></p>
                        <p><strong>Durasi:</strong> <?= $searchResult->getDurasiMenit() ?> menit</p>
                        <p><strong>Rating:</strong> ★ <?= sprintf("%.1f", $searchResult->getRating()) ?> / 10.0</p>
                        
                        <!-- Tombol Aksi Operasi pada Detail -->
                        <div class="btn-group">
                            <a href="index.php?editId=<?= urlencode($searchResult->getIdFilm()) ?>" class="btn btn-yellow">Edit</a>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus film ini?');">
                                <input type="hidden" name="action" value="hapus">
                                <input type="hidden" name="idFilm" value="<?= htmlspecialchars($searchResult->getIdFilm()) ?>">
                                <button type="submit" class="btn btn-red">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Modul Katalog Utama Data Film (Tampilan Grid ala Platform Streaming) -->
        <div class="card">
            <h2>KATALOG DATA FILM</h2>
            
            <!-- Menampilkan Pesan Jika Belum Ada Film Terdaftar -->
            <?php if (empty($_SESSION['daftarFilm'])): ?>
                <p style="text-align:center; color:#94a3b8; padding:20px 0;">Belum ada data film yang tersimpan dalam sistem.</p>
            <?php else: ?>
                <!-- Grid Kontainers Kartu Film -->
                <div class="film-grid">
                    <?php foreach ($_SESSION['daftarFilm'] as $f): ?>
                        <!-- Kartu Film Individual -->
                        <div class="film-card">
                            <!-- Wrapper Poster Berasio 2:3 dengan Rating Badge Melayang -->
                            <div class="poster-wrapper">
                                <?php if ($f->getGambar()): ?>
                                    <img src="<?= htmlspecialchars($f->getGambar()) ?>" class="film-card-img" alt="<?= htmlspecialchars($f->getJudul()) ?>">
                                <?php else: ?>
                                    <div class="film-card-no-img">Tidak Ada Poster</div>
                                <?php endif; ?>
                                <!-- Lencana Rating Bintang di Pojok Poster -->
                                <span class="rating-badge">★ <?= sprintf("%.1f", $f->getRating()) ?></span>
                            </div>

                            <!-- Body Kartu Konten Teks -->
                            <div class="film-card-body">
                                <div>
                                    <h3><?= htmlspecialchars($f->getJudul()) ?></h3>
                                    <span class="genre-tag"><?= htmlspecialchars($f->getGenre()) ?></span>
                                    <p><strong>ID:</strong> <?= htmlspecialchars($f->getIdFilm()) ?></p>
                                    <p><strong>Durasi:</strong> <?= $f->getDurasiMenit() ?> menit</p>
                                </div>
                                
                                <!-- Tombol Aksi Edit & Hapus pada Setiap Kartu -->
                                <div class="btn-group">
                                    <a href="index.php?editId=<?= urlencode($f->getIdFilm()) ?>" class="btn btn-yellow" style="padding: 6px 12px; font-size: 0.8em;">Edit</a>
                                    <form method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus film ini?');">
                                        <input type="hidden" name="action" value="hapus">
                                        <input type="hidden" name="idFilm" value="<?= htmlspecialchars($f->getIdFilm()) ?>">
                                        <button type="submit" class="btn btn-red" style="padding: 6px 12px; font-size: 0.8em;">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Menampilkan Jumlah Total Film yang Tersimpan -->
                <p style="margin-top:20px; font-weight:bold; color:#94a3b8;">Total Koleksi Film: <?= count($_SESSION['daftarFilm']) ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>