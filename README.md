
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
├── Error Handling/
│   ├── CPP, Java, dan Python/
│   │   ├── Tambah Data/
│   │   │   ├── Durasi Angka Nol atau Negatif.png
│   │   │   ├── Durasi Bukan Angka Bulat.png
│   │   │   ├── Genre Teks Kosong.png
│   │   │   ├── ID Duplikat.png
│   │   │   ├── ID Teks Kosong.png
│   │   │   ├── Judul Teks Kosong.png
│   │   │   ├── Rating Bukan Desimal.png
│   │   │   └── Rating Di Luar Rentang.png
│   │   ├── Tampilkan Data/
│   │   │   └── Data Kosong.png
│   │   ├── Update Data/
│   │   │   ├── Data Masih kosong.png
│   │   │   ├── Durasi Angka Nol atau Negatif.png
│   │   │   ├── Durasi Bukan Angka Bulat.png
│   │   │   ├── ID Baru Duplikat.png
│   │   │   ├── ID Tidak Ditemukan.png
│   │   │   └── Rating Di Luar Rentang.png
│   │   ├── Hapus Data/
│   │   │   ├── Data Masih Kosong.png
│   │   │   └── ID Tidak Ditemukan.png
│   │   ├── Cari Data/
│   │   │   ├── Data Masih Kosong.png
│   │   │   └── ID Tidak Ditemukan.png
│   │   └── Lainnya/
│   │       └── Input Menu Tidak Valid.png
│   └── PHP/
│       ├── Cari ID Tidak Ditemukan .png
│       ├── Data Kosong.png
│       ├── Durasi Angka Nol atau Negatif 1.png
│       ├── Durasi Angka Nol atau Negatif 2.png
│       ├── Durasi Baru Bukan Angka Positif 1.png
│       ├── Durasi Baru Bukan Angka Positif 2.png
│       ├── ID Baru Duplikat 1.png
│       ├── ID Baru Duplikat 2.png
│       ├── ID Duplikat 1.png
│       ├── ID Duplikat 2.png
│       ├── Rating Baru Di Luar Rentang 2.png
│       ├── Rating Baru Di Luar Rentang.png
│       ├── Rating Di Luar Rentang 1.png
│       └── Rating Di Luar Rentang 2.png
└── README.md

```

---

## Penjelasan Desain dan Flow Kode

### Desain Pemrograman Berorientasi Objek (OOP)

Program ini dibangun menggunakan konsep **Object-Oriented Programming (OOP)** yang mengimplementasikan **Enkapsulasi** untuk membungkus data film ke dalam sebuah kelas bernama `Film`.

#### Class `Film`

Atribut yang digunakan pada kelas `Film` meliputi:

| Atribut | Tipe Data | Deskripsi |
| --- | --- | --- |
| `id` | String | Identifier unik untuk setiap film |
| `judul` | String | Judul film |
| `genre` | String | Genre atau kategori film |
| `durasi` | Integer | Durasi film dalam satuan menit (> 0) |
| `rating` | Float / Double | Rating film dalam rentang 0.0 - 10.0 |
| `gambar` | String | Relative path berkas poster film (*Khusus PHP*) |

---

### Sample Gambar Poster Film (PHP/images)

* **Avatar The Way of Water**:
<img src="./PHP/images/Avatar%20The%20Way%20of%20Water.jpeg" width="200" alt="Avatar The Way of Water">
* **Avengers Infinity War**:
<img src="./PHP/images/Avengers%20Infinity%20War.jpg" width="200" alt="Avengers Infinity War">
* **Godzilla Minus One**:
<img src="./PHP/images/Godzilla%20Minus%20One.jpg" width="200" alt="Godzilla Minus One">
* **Moana**:
<img src="./PHP/images/Moana.jpg" width="200" alt="Moana">
* **Oppenheimer**:
<img src="./PHP/images/Oppenheimer.jpg" width="200" alt="Oppenheimer">
* **Titanic**:
<img src="./PHP/images/Titanic.jpg" width="200" alt="Titanic">

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
└───────────────────────────┬─────────────────────────────┘

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

<img src="./Dokumentasi/Lainnya/Tampilan%20Pilihan%20Menu.png" width="600" alt="Tampilan Pilihan Menu">

### Keluar dari Program

<img src="./Dokumentasi/Lainnya/Keluar%20Program.png" width="600" alt="Keluar Program">

---

## Dokumentasi Output Program C++

### Cara Kompilasi dan Menjalankan

```bash
cd CPP/
g++ main.cpp Film.cpp -o main
./main

```

### 1. Menambahkan Data (Tambah Data)

<img src="./Dokumentasi/CPP/Tambah%20Data.png" width="600" alt="Tambah Data C++">

### 2. Menampilkan Data (Tampilkan Data)

<img src="./Dokumentasi/CPP/Tampilkan%20Data.png" width="600" alt="Tampilkan Data C++">

### 3. Memperbarui Data (Update Data)

<img src="./Dokumentasi/CPP/Update%20Data.png" width="600" alt="Update Data C++">

### 4. Menghapus Data (Hapus Data)

<img src="./Dokumentasi/CPP/Hapus%20Data.png" width="600" alt="Hapus Data C++">

### 5. Mencari Data (Cari Data)

<img src="./Dokumentasi/CPP/Cari%20Data.png" width="600" alt="Cari Data C++">

---

## Dokumentasi Output Program Java

### Cara Kompilasi dan Menjalankan

```bash
cd Java/
javac Main.java Film.java
java Main

```

### 1. Menambahkan Data (Tambah Data)

<img src="./Dokumentasi/Java/Tambah%20Data.png" width="600" alt="Tambah Data Java">

### 2. Menampilkan Data (Tampilkan Data)

<img src="./Dokumentasi/Java/Tampilkan%20Data.png" width="600" alt="Tampilkan Data Java">

### 3. Memperbarui Data (Update Data)

<img src="./Dokumentasi/Java/Update%20Data.png" width="600" alt="Update Data Java">

### 4. Menghapus Data (Hapus Data)

<img src="./Dokumentasi/Java/Hapus%20Data.png" width="600" alt="Hapus Data Java">

### 5. Mencari Data (Cari Data)

<img src="./Dokumentasi/Java/Cari%20Data.png" width="600" alt="Cari Data Java">

---

## Dokumentasi Output Program Python

### Cara Menjalankan

```bash
cd Python/
python main.py

```

### 1. Menambahkan Data (Tambah Data)

<img src="./Dokumentasi/Python/Tambah%20Data.png" width="600" alt="Tambah Data Python">

### 2. Menampilkan Data (Tampilkan Data)

<img src="./Dokumentasi/Python/Tampilkan%20Data.png" width="600" alt="Tampilkan Data Python">

### 3. Memperbarui Data (Update Data)

<img src="./Dokumentasi/Python/Update%20Data.png" width="600" alt="Update Data Python">

### 4. Menghapus Data (Hapus Data)

<img src="./Dokumentasi/Python/Hapus%20Data.png" width="600" alt="Hapus Data Python">

### 5. Mencari Data (Cari Data)

<img src="./Dokumentasi/Python/Cari%20Data.png" width="600" alt="Cari Data Python">

---

## Dokumentasi Output Program PHP (Web UI)

### Cara Menjalankan

```bash
cd PHP/
php -S localhost:8000

```

Buka peramban (*browser*) dan akses `http://localhost:8000/index.php`.

### Tampilan Antarmuka Web

<img src="./Dokumentasi/Lainnya/Tampilan%20Web.png" width="600" alt="Tampilan Web PHP">

### 1. Menambahkan Data (Tambah Data)

* **Mengisi Form Tambah Data**:
<img src="./Dokumentasi/PHP/Tambah%20Data%201.png" width="600" alt="Form Tambah Data PHP">
* **Pemberitahuan Berhasil Ditambahkan**:
<img src="./Dokumentasi/PHP/Tambah%20data%202.png" width="600" alt="Notifikasi Tambah Data PHP">
* **Data Baru Muncul di Katalog**:
<img src="./Dokumentasi/PHP/Tambah%20Data%203.png" width="600" alt="Hasil Tambah Data PHP">

### 2. Menampilkan Data (Tampilkan Data)

<img src="./Dokumentasi/PHP/Tampilkan%20Data.png" width="600" alt="Tampilkan Data PHP">

### 3. Memperbarui Data (Update Data)

* **Memilih Film yang Ingin Di-update**:
<img src="./Dokumentasi/PHP/Update%20Data%201.png" width="600" alt="Pilih Update PHP">
* **Mengubah Isian Data pada Form**:
<img src="./Dokumentasi/PHP/Update%20Data%202.png" width="600" alt="Form Edit PHP">
* **Notifikasi Berhasil Diperbarui**:
<img src="./Dokumentasi/PHP/Update%20Data%203.png" width="600" alt="Notifikasi Update PHP">
* **Hasil Perubahan Data di Katalog**:
<img src="./Dokumentasi/PHP/Update%20data%204.png" width="600" alt="Hasil Update PHP">

### 4. Menghapus Data (Hapus Data)

* **Memilih Data Film yang Akan Dihapus**:
<img src="./Dokumentasi/PHP/Hapus%20Data%201.png" width="600" alt="Pilih Hapus PHP 1">
* **Konfirmasi Penghapusan Data**:
<img src="./Dokumentasi/PHP/Hapus%20Data%202.png" width="600" alt="Konfirmasi Hapus PHP">
* **Notifikasi Data Berhasil Dihapus**:
<img src="./Dokumentasi/PHP/Hapus%20Data%203.png" width="600" alt="Notifikasi Hapus PHP">
* **Katalog Setelah Data Dihapus**:
<img src="./Dokumentasi/PHP/Hapus%20Data%204.png" width="600" alt="Katalog Setelah Hapus PHP">

### 5. Mencari Data (Cari Data)

* **Menginput ID Film yang Dicari**:
<img src="./Dokumentasi/PHP/Cari%20Data%201.png" width="600" alt="Form Cari PHP">
* **Hasil Pencarian Film Ditemukan**:
<img src="./Dokumentasi/PHP/Cari%20Data%202.png" width="600" alt="Hasil Cari PHP">

---

## Dokumentasi Penanganan Eror (Error Handling)

### A. Program CLI (C++, Java, dan Python)

#### 1. Tambah Data

* **ID Teks Kosong**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tambah%20Data/ID%20Teks%20Kosong.png" width="600" alt="ID Teks Kosong CLI">
* **ID Duplikat**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tambah%20Data/ID%20Duplikat.png" width="600" alt="ID Duplikat CLI">
* **Judul Teks Kosong**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tambah%20Data/Judul%20Teks%20Kosong.png" width="600" alt="Judul Teks Kosong CLI">
* **Genre Teks Kosong**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tambah%20Data/Genre%20Teks%20Kosong.png" width="600" alt="Genre Teks Kosong CLI">
* **Durasi Bukan Angka Bulat**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tambah%20Data/Durasi%20Bukan%20Angka%20Bulat.png" width="600" alt="Durasi Bukan Angka Bulat CLI">
* **Durasi Angka Nol atau Negatif**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tambah%20Data/Durasi%20Angka%20Nol%20atau%20Negatif.png" width="600" alt="Durasi Nol Negatif CLI">
* **Rating Bukan Desimal**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tambah%20Data/Rating%20Bukan%20Desimal.png" width="600" alt="Rating Bukan Desimal CLI">
* **Rating Di Luar Rentang**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tambah%20Data/Rating%20Di%20Luar%20Rentang.png" width="600" alt="Rating Di Luar Rentang CLI">

#### 2. Tampilkan Data

* **Data Kosong**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Tampilkan%20Data/Data%20Kosong.png" width="600" alt="Data Kosong Tampilkan CLI">

#### 3. Update Data

* **Data Masih Kosong**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Update%20Data/Data%20Masih%20kosong.png" width="600" alt="Data Masih Kosong Update CLI">
* **ID Tidak Ditemukan**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Update%20Data/ID%20Tidak%20Ditemukan.png" width="600" alt="ID Tidak Ditemukan Update CLI">
* **ID Baru Duplikat**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Update%20Data/ID%20Baru%20Duplikat.png" width="600" alt="ID Baru Duplikat Update CLI">
* **Durasi Bukan Angka Bulat**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Update%20Data/Durasi%20Bukan%20Angka%20Bulat.png" width="600" alt="Durasi Bukan Angka Bulat Update CLI">
* **Durasi Angka Nol atau Negatif**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Update%20Data/Durasi%20Angka%20Nol%20atau%20Negatif.png" width="600" alt="Durasi Nol Negatif Update CLI">
* **Rating Di Luar Rentang**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Update%20Data/Rating%20Di%20Luar%20Rentang.png" width="600" alt="Rating Di Luar Rentang Update CLI">

#### 4. Hapus Data

* **Data Masih Kosong**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Hapus%20Data/Data%20Masih%20Kosong.png" width="600" alt="Data Masih Kosong Hapus CLI">
* **ID Tidak Ditemukan**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Hapus%20Data/ID%20Tidak%20Ditemukan.png" width="600" alt="ID Tidak Ditemukan Hapus CLI">

#### 5. Cari Data

* **Data Masih Kosong**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Cari%20Data/Data%20Masih%20Kosong.png" width="600" alt="Data Masih Kosong Cari CLI">
* **ID Tidak Ditemukan**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Cari%20Data/ID%20Tidak%20Ditemukan.png" width="600" alt="ID Tidak Ditemukan Cari CLI">

#### 6. Lainnya

* **Input Menu Tidak Valid**:
<img src="./Error%20Handling/CPP,%20Java,%20dan%20Python/Lainnya/Input%20Menu%20Tidak%20Valid.png" width="600" alt="Input Menu Tidak Valid CLI">

---

### B. Program PHP Web UI

* **Katalog Data Kosong**:
<img src="./Error%20Handling/PHP/Data%20Kosong.png" width="600" alt="Data Kosong PHP">
* **ID Duplikat Saat Tambah Data (Kondisi 1 & 2)**:
<img src="./Error%20Handling/PHP/ID%20Duplikat%201.png" width="600" alt="ID Duplikat PHP 1">




<img src="./Error%20Handling/PHP/ID%20Duplikat%202.png" width="600" alt="ID Duplikat PHP 2">
* **ID Baru Duplikat Saat Update Data (Kondisi 1 & 2)**:
<img src="./Error%20Handling/PHP/ID%20Baru%20Duplikat%201.png" width="600" alt="ID Baru Duplikat PHP 1">




<img src="./Error%20Handling/PHP/ID%20Baru%20Duplikat%202.png" width="600" alt="ID Baru Duplikat PHP 2">
* **Durasi Angka Nol atau Negatif Saat Tambah Data (Kondisi 1 & 2)**:
<img src="./Error%20Handling/PHP/Durasi%20Angka%20Nol%20atau%20Negatif%201.png" width="600" alt="Durasi Nol Negatif PHP 1">




<img src="./Error%20Handling/PHP/Durasi%20Angka%20Nol%20atau%20Negatif%202.png" width="600" alt="Durasi Nol Negatif PHP 2">
* **Durasi Baru Bukan Angka Positif Saat Update Data (Kondisi 1 & 2)**:
<img src="./Error%20Handling/PHP/Durasi%20Baru%20Bukan%20Angka%20Positif%201.png" width="600" alt="Durasi Baru Bukan Angka Positif PHP 1">




<img src="./Error%20Handling/PHP/Durasi%20Baru%20Bukan%20Angka%20Positif%202.png" width="600" alt="Durasi Baru Bukan Angka Positif PHP 2">
* **Rating Di Luar Rentang Saat Tambah Data (Kondisi 1 & 2)**:
<img src="./Error%20Handling/PHP/Rating%20Di%20Luar%20Rentang%201.png" width="600" alt="Rating Di Luar Rentang PHP 1">




<img src="./Error%20Handling/PHP/Rating%20Di%20Luar%20Rentang%202.png" width="600" alt="Rating Di Luar Rentang PHP 2">
* **Rating Baru Di Luar Rentang Saat Update Data (Kondisi 1 & 2)**:
<img src="./Error%20Handling/PHP/Rating%20Baru%20Di%20Luar%20Rentang.png" width="600" alt="Rating Baru Di Luar Rentang PHP 1">




<img src="./Error%20Handling/PHP/Rating%20Baru%20Di%20Luar%20Rentang%202.png" width="600" alt="Rating Baru Di Luar Rentang PHP 2">
* **Cari ID Tidak Ditemukan**:
<img src="./Error%20Handling/PHP/Cari%20ID%20Tidak%20Ditemukan%20.png" width="600" alt="Cari ID Tidak Ditemukan PHP">

