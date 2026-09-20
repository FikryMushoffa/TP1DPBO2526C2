<?php
// Class Film: Blueprint objek data film
class Film {
    // Deklarasi atribut/properti privat milik objek
    private string $idFilm;      // Menyimpan ID unik film
    private string $judul;       // Menyimpan judul film
    private string $genre;       // Menyimpan genre film
    private int $durasiMenit;    // Menyimpan durasi film dalam hitungan menit
    private float $rating;       // Menyimpan rating film (skala 0.0 - 10.0)
    private string $gambar;      // Menyimpan path file gambar poster lokal

    // Constructor: Menginisialisasi nilai awal properti saat objek baru dibuat
    public function __construct(
        string $idFilm = "",
        string $judul = "",
        string $genre = "",
        int $durasiMenit = 0,
        float $rating = 0.0,
        string $gambar = ""
    ) {
        $this->idFilm = $idFilm;
        $this->judul = $judul;
        $this->genre = $genre;
        $this->durasiMenit = $durasiMenit;
        $this->rating = $rating;
        $this->gambar = $gambar;
    }

    // --- Getter & Setter Methods ---

    // Mengambil nilai atribut idFilm
    public function getIdFilm(): string {
        return $this->idFilm;
    }

    // Mengisi atau memperbarui nilai atribut idFilm
    public function setIdFilm(string $idFilm): void {
        $this->idFilm = $idFilm;
    }

    // Mengambil nilai atribut judul
    public function getJudul(): string {
        return $this->judul;
    }

    // Mengisi atau memperbarui nilai atribut judul
    public function setJudul(string $judul): void {
        $this->judul = $judul;
    }

    // Mengambil nilai atribut genre
    public function getGenre(): string {
        return $this->genre;
    }

    // Mengisi atau memperbarui nilai atribut genre
    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }

    // Mengambil nilai atribut durasiMenit
    public function getDurasiMenit(): int {
        return $this->durasiMenit;
    }

    // Mengisi nilai durasiMenit dengan validasi angka positif
    public function setDurasiMenit(int $durasiMenit): void {
        if ($durasiMenit > 0) {
            $this->durasiMenit = $durasiMenit;
        }
    }

    // Mengambil nilai atribut rating
    public function getRating(): float {
        return $this->rating;
    }

    // Mengisi nilai rating dengan validasi rentang 0.0 sampai 10.0
    public function setRating(float $rating): void {
        if ($rating >= 0.0 && $rating <= 10.0) {
            $this->rating = $rating;
        }
    }

    // Mengambil path lokasi file gambar poster
    public function getGambar(): string {
        return $this->gambar;
    }

    // Mengisi atau memperbarui path file gambar poster
    public function setGambar(string $gambar): void {
        $this->gambar = $gambar;
    }
}
?>