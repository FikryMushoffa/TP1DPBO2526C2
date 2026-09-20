# TP1 DPBO 2025/2026 C2

## Janji
Saya R Mohammad Fikry Mushoffa S dengan NIM 2502049 mengerjakan Tugas Praktikum 1 pada Mata Kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

---

## Struktur Folder

```text
├── CPP/
│   ├── Film.cpp
│   └── main.cpp
├── Java/
│   ├── Film.java
│   └── Main.java
├── Python/
│   ├── Film.py
│   └── main.py
├── PHP/
│   ├── Film.php
│   ├── index.php
│   └── images/
│       ├── Avatar The Way of Water.jpeg
│       ├── Avengers Infinity War.jpg
│       ├── Godzilla Minus One.jpg
│       ├── Moana.jpg
│       ├── Oppenheimer.jpg
│       └── Titanic.jpg
├── Dokumentasi/
│   ├── CPP/
│   │   ├── Tambah Data.png
│   │   ├── Tampilkan Data.png
│   │   ├── Update Data.png
│   │   ├── Hapus Data.png
│   │   └── Cari Data.png
│   ├── Java/
│   │   ├── Tambah Data.png
│   │   ├── Tampilkan Data.png
│   │   ├── Update Data.png
│   │   ├── Hapus Data.png
│   │   └── Cari Data.png
│   ├── Python/
│   │   ├── Tambah Data.png
│   │   ├── Tampilkan Data.png
│   │   ├── Update Data.png
│   │   ├── Hapus Data.png
│   │   └── Cari Data.png
│   ├── PHP/
│   │   ├── Tambah Data 1.png
│   │   ├── Tambah data 2.png
│   │   ├── Tambah Data 3.png
│   │   ├── Tampilkan Data.png
│   │   ├── Update Data 1.png
│   │   ├── Update Data 2.png
│   │   ├── Update Data 3.png
│   │   ├── Update data 4.png
│   │   ├── Hapus Data 1.png
│   │   ├── Hapus Data 2.png
│   │   ├── Hapus Data 3.png
│   │   ├── Hapus Data 4.png
│   │   ├── Cari Data 1.png
│   │   └── Cari Data 2.png
│   └── Lainnya/
│       ├── Keluar Program.png
│       ├── Tampilan Pilihan Menu.png
│       └── Tampilan Web.png
└── Error Handling/
    ├── CPP, Java, dan Python/
    │   ├── Tambah Data/
    │   │   ├── Durasi Angka Nol atau Negatif.png
    │   │   ├── Durasi Bukan Angka Bulat.png
    │   │   ├── Genre Teks Kosong.png
    │   │   ├── ID Duplikat.png
    │   │   ├── ID Teks Kosong.png
    │   │   ├── Judul Teks Kosong.png
    │   │   ├── Rating Bukan Desimal.png
    │   │   └── Rating Di Luar Rentang.png
    │   ├── Tampilkan Data/
    │   │   └── Data Kosong.png
    │   ├── Update Data/
    │   │   ├── Data Masih kosong.png
    │   │   ├── Durasi Angka Nol atau Negatif.png
    │   │   ├── Durasi Bukan Angka Bulat.png
    │   │   ├── ID Baru Duplikat.png
    │   │   ├── ID Tidak Ditemukan.png
    │   │   └── Rating Di Luar Rentang.png
    │   ├── Hapus Data/
    │   │   ├── Data Masih Kosong.png
    │   │   └── ID Tidak Ditemukan.png
    │   ├── Cari Data/
    │   │   ├── Data Masih Kosong.png
    │   │   └── ID Tidak Ditemukan.png
    │   └── Lainnya/
    │       └── Input Menu Tidak Valid.png
    └── PHP/
        ├── Cari ID Tidak Ditemukan .png
        ├── Data Kosong.png
        ├── Durasi Angka Nol atau Negatif 1.png
        ├── Durasi Angka Nol atau Negatif 2.png
        ├── Durasi Baru Bukan Angka Positif 1.png
        ├── Durasi Baru Bukan Angka Positif 2.png
        ├── ID Baru Duplikat 1.png
        ├── ID Baru Duplikat 2.png
        ├── ID Duplikat 1.png
        ├── ID Duplikat 2.png
        ├── Rating Baru Di Luar Rentang 2.png
        ├── Rating Baru Di Luar Rentang.png
        ├── Rating Di Luar Rentang 1.png
        └── Rating Di Luar Rentang 2.png

```

---

## Penjelasan Desain dan Flow Kode

### Desain Pemrograman Berorientasi Objek (OOP)

Program ini dibangun menggunakan konsep **Object-Oriented Programming (OOP)** yang mengimplementasikan **Enkapsulasi** untuk membungkus data film ke dalam sebuah kelas bernama `Film`.

#### Class `Film`

Atribut yang digunakan pada kelas `Film` meliputi:

| Atribut | Tipe Data | Deskripsi |
| --- | --- | --- |
| `idFilm` | String | Identifier unik untuk setiap film |
| `judul` | String | Judul film |
| `genre` | String | Genre atau kategori film |
| `durasiMenit` | Integer | Durasi film dalam satuan menit (> 0) |
| `rating` | Float / Double | Rating film dalam rentang 0.0 - 10.0 |
| `gambar` | String | Relative path berkas poster film (*Khusus PHP*) |

---

### Flow Kode Program

```text
┌─────────────────────────────────────────────────────────┐
│                      START PROGRAM                      │
└───────────────────────────┬─────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────┐
│              MENAMPILKAN PILIHAN MENU UTAMA             │
│  1. Tambah Data  2. Tampilkan  3. Update  4. Hapus      │
│  5. Cari Data    6. Keluar                              │
└───────────────────────────┬─────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────┐
│                  INPUT PILIHAN USER                     │
└──────┬──────────┬───────────┬───────────┬──────────┬────┘
       │          │           │           │          │
       ▼          ▼           ▼           ▼          ▼
   [Tambah]   [Tampilkan]  [Update]    [Hapus]    [Cari]
       │          │           │           │          │
       ├──────────┴───────────┴───────────┴──────────┤
       │           VALIDASI INPUT & ERROR             │
       │  - Cek ID unik / duplikat                   │
       │  - Cek input kosong                          │
       │  - Cek durasi > 0                            │
       │  - Cek rating 0.0 - 10.0                     │
       └──────────────────────┬──────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────┐
│              EKSEKUSI OPERASI DATA (CRUD)               │
└───────────────────────────┬─────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────┐
│                     KEMBALI KE MENU                     │
└─────────────────────────────────────────────────────────┘

```

1. **Inisialisasi**: Program CLI (C++, Java, Python) menggunakan *looping* menu interaktif dengan pewarnaan terminal ANSI, sedangkan PHP Web menggunakan pendekatan *session-based storage* (`$_SESSION['daftarFilm']`).
2. **Pilihan Menu**: Pengguna memilih fitur yang ingin dijalankan (Tambah, Tampilkan, Update, Hapus, Cari, atau Keluar).
3. **Validasi Input**: Setiap masukan diperiksa melalui helper function/validasi untuk memastikan tidak ada ID duplikat, teks kosong, durasi nol/negatif, atau rating di luar rentang 0.0 - 10.0.
4. **Eksekusi & Respon**: Jika valid, data diperbarui pada daftar/array objek `Film` dan sistem menampilkan status sukses. Jika gagal, pesan kesalahan ditunjukkan secara jelas.

---

## Penjelasan Fitur Utama

| Fitur | Deskripsi |
| --- | --- |
| **Tambah Data** | Menambahkan data film baru ke dalam sistem (ID, Judul, Genre, Durasi, Rating, serta Gambar pada PHP). |
| **Tampilkan Data** | Menampilkan seluruh daftar film yang tersimpan dalam format tabel terstruktur (CLI) atau *card grid UI* (PHP Web). |
| **Update Data** | Mengubah informasi film berdasarkan ID unik. Menekan `[ENTER]` tanpa mengisi akan mempertahankan data lama. |
| **Hapus Data** | Menghapus record film dari koleksi berdasarkan ID unik. |
| **Cari Data** | Mencari dan menampilkan detail satu film spesifik berdasarkan ID unik. |

---

## Tampilan Utama & Navigasi CLI

### Tampilan Pilihan Menu Utama

### Keluar dari Program

---

## Dokumentasi Output Program C++

### Cara Kompilasi dan Menjalankan

```bash
cd CPP/
g++ main.cpp Film.cpp -o main
./main

```

### 1. Menambahkan Data (Tambah Data)

### 2. Menampilkan Data (Tampilkan Data)

### 3. Memperbarui Data (Update Data)

### 4. Menghapus Data (Hapus Data)

### 5. Mencari Data (Cari Data)

---

## Dokumentasi Output Program Java

### Cara Kompilasi dan Menjalankan

```bash
cd Java/
javac Main.java Film.java
java Main

```

### 1. Menambahkan Data (Tambah Data)

### 2. Menampilkan Data (Tampilkan Data)

### 3. Memperbarui Data (Update Data)

### 4. Menghapus Data (Hapus Data)

### 5. Mencari Data (Cari Data)

---

## Dokumentasi Output Program Python

### Cara Menjalankan

```bash
cd Python/
python main.py

```

### 1. Menambahkan Data (Tambah Data)

### 2. Menampilkan Data (Tampilkan Data)

### 3. Memperbarui Data (Update Data)

### 4. Menghapus Data (Hapus Data)

### 5. Mencari Data (Cari Data)

---

## Dokumentasi Output Program PHP (Web UI)

### Cara Menjalankan

```bash
cd PHP/
php -S localhost:8000

```

Buka peramban (*browser*) dan akses `http://localhost:8000/index.php`.

### Tampilan Antarmuka Web

### 1. Menambahkan Data (Tambah Data)

* **Mengisi Form Tambah Data**:
* **Pemberitahuan Berhasil Ditambahkan**:
* **Data Baru Muncul di Katalog**:

### 2. Menampilkan Data (Tampilkan Data)

### 3. Memperbarui Data (Update Data)

* **Memilih Film yang Ingin Di-update**:
* **Mengubah Isian Data pada Form**:
* **Notifikasi Berhasil Diperbarui**:
* **Hasil Perubahan Data di Katalog**:

### 4. Menghapus Data (Hapus Data)

* **Memilih Data Film yang Akan Dihapus**:
* **Konfirmasi Penghapusan Data**:
* **Notifikasi Data Berhasil Dihapus**:
* **Katalog Setelah Data Dihapus**:

### 5. Mencari Data (Cari Data)

* **Menginput ID Film yang Dicari**:
* **Hasil Pencarian Film Ditemukan**:

---

## Dokumentasi Penanganan Eror (Error Handling)

### A. Program CLI (C++, Java, dan Python)

#### 1. Tambah Data

* **ID Teks Kosong**:
* **ID Duplikat**:
* **Judul Teks Kosong**:
* **Genre Teks Kosong**:
* **Durasi Bukan Angka Bulat**:
* **Durasi Angka Nol atau Negatif**:
* **Rating Bukan Desimal**:
* **Rating Di Luar Rentang**:

#### 2. Tampilkan Data

* **Data Kosong**:

#### 3. Update Data

* **Data Masih Kosong**:
* **ID Tidak Ditemukan**:
* **ID Baru Duplikat**:
* **Durasi Bukan Angka Bulat**:
* **Durasi Angka Nol atau Negatif**:
* **Rating Di Luar Rentang**:

#### 4. Hapus Data

* **Data Masih Kosong**:
* **ID Tidak Ditemukan**:

#### 5. Cari Data

* **Data Masih Kosong**:
* **ID Tidak Ditemukan**:

#### 6. Lainnya

* **Input Menu Tidak Valid**:

---

### B. Program PHP Web UI

* **Katalog Data Kosong**:
* **ID Duplikat Saat Tambah Data (Kondisi 1 & 2)**:
* **ID Baru Duplikat Saat Update Data (Kondisi 1 & 2)**:
* **Durasi Angka Nol atau Negatif Saat Tambah Data (Kondisi 1 & 2)**:
* **Durasi Baru Bukan Angka Positif Saat Update Data (Kondisi 1 & 2)**:
* **Rating Di Luar Rentang Saat Tambah Data (Kondisi 1 & 2)**:
* **Rating Baru Di Luar Rentang Saat Update Data (Kondisi 1 & 2)**:
* **Cari ID Tidak Ditemukan**:

```

```
