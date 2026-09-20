from Film import Film

# List penampung objek Film sebagai database sementara di memori
daftarFilm = []

# Array string penampung nama-nama header kolom tabel
HEADERS = ["ID Film", "Judul Film", "Genre", "Durasi (Menit)", "Rating"] # final agar nilainya terkunci
# List integer untuk mengelola lebar relatif kolom tabel
colWidths = [0] * 5

# Kode ANSI 
# final agar nilainya terkunci dan tidak dapat diubah lagi sampai program selesai
RESET = "\033[0m"   # mereset format teks terminal
RED = "\033[31m"     # warna merah
GREEN = "\033[32m"   # warna hijau
CYAN = "\033[36m"    # warna cyan
YELLOW = "\033[33m"  # warna kuning
BOLD = "\033[1m"     # teks cetak tebal

# Method untuk menghitung ulang lebar kolom agar tampilan tabel pas dengan isi data
def resetColWidths():
    # Mengisi lebar awal berdasarkan panjang teks header masing-masing kolom 
    for i in range(len(HEADERS)):
        colWidths[i] = len(HEADERS[i])  # Menyesuaikan lebar awal kolom i

    # Melakukan iterasi ke seluruh data film untuk mencari teks terpanjang dengan membandingkan lebar tiap kolom
    for f in daftarFilm:
        colWidths[0] = max(colWidths[0], len(f.getIdFilm()))
        colWidths[1] = max(colWidths[1], len(f.getJudul()))
        colWidths[2] = max(colWidths[2], len(f.getGenre()))
        colWidths[3] = max(colWidths[3], len(str(f.getDurasiMenit())))
        colWidths[4] = max(colWidths[4], len(f"{f.getRating():.1f}"))

# Method pencari indeks objek film dalam list berdasarkan ID
def findIndexById(idFilm: str) -> int:
    # Perulangan untuk memeriksa tiap elemen di daftarFilm
    for i in range(len(daftarFilm)):
        # Membandingkan ID film tanpa membedakan huruf besar atau kecil
        if daftarFilm[i].getIdFilm().lower() == idFilm.lower():
            return i  # Mengembalikan posisi indeks jika ID ditemukan
    return -1  # Mengembalikan nilai -1 jika ID tidak ditemukan

# Method pembantu input string dengan validasi tidak boleh kosong
def inputString(prompt: str, defaultValue: str = None) -> str:
    while True:  # Perulangan terus menerus sampai dapat input yang valid
        input_val = input(prompt).strip()  # Membaca baris input dan menghapus spasi di awal/akhir
        if input_val:
            return input_val  # Mengembalikan teks jika input tidak kosong
        if defaultValue is not None:
            return defaultValue  # Mengembalikan nilai default jika disediakan
        print(RED + "  [ERROR] Input tidak boleh kosong!" + RESET)  # Menampilkan peringatan error

# Method pembantu input bilangan bulat dengan validasi nilai positif
def inputInt(prompt: str, defaultValue: str = None) -> int:
    while True:  # Perulangan terus menerus sampai didapat angka valid
        input_val = input(prompt).strip()  # Membaca input berupa teks
        # Memeriksa jika input kosong tetapi ada nilai default yang tersimpan
        if not input_val and defaultValue is not None:
            return int(defaultValue)  # Mengonversi dan mengembalikan nilai default
        try:  # Mencoba melakukan konversi dari String ke int
            val = int(input_val)  # Mengubah format string menjadi integer
            if val > 0:
                return val  # Mengembalikan nilai jika angka lebih dari 0
            print(RED + "  [ERROR] Nilai harus bilangan bulat positif (lebih dari 0)!" + RESET)  # Error jika angka <= 0
        except ValueError:  # Menangkap exception jika input bukan berupa angka
            print(RED + "  [ERROR] Input harus berupa angka bulat!" + RESET)  # Pesan kesalahan tipe data

# Method pembantu input rating dengan rentang validasi 0.0 - 10.0
def inputRating(prompt: str, defaultValue: str = None) -> float:
    while True:  # Perulangan sampai didapatkan angka desimal yang valid
        input_val = input(prompt).strip()  # Membaca input berupa teks
        # Memeriksa jika input kosong tetapi terdapat nilai default
        if not input_val and defaultValue is not None:
            return float(defaultValue)  # Mengonversi dan mengembalikan nilai default float
        try:  # Mencoba mengonversi dari String ke float
            val = float(input_val)  # Mengubah nilai menjadi float
            if 0.0 <= val <= 10.0:
                return val  # Mengembalikan nilai jika berada di rentang 0-10
            print(RED + "  [ERROR] Rating harus berada di rentang 0.0 - 10.0!" + RESET)  # Error jika out of range
        except ValueError:  # Menangkap exception jika input bukan desimal
            print(RED + "  [ERROR] Input harus berupa angka desimal (contoh: 8.5)!" + RESET)  # Pesan kesalahan tipe

# Method untuk mencetak garis horizontal pembatas tabel
def printSeparator():
    for width in colWidths:  # Iterasi ke setiap lebar kolom
        print("+", end="")
        print("-" * (width + 2), end="")
    print("+")

# Method untuk mencetak satu baris teks pada tabel
def printRow(columns: list):
    for i in range(len(columns)):  # Perulangan sesuai jumlah kolom
        print("| " + columns[i], end="")
        print(" " * (colWidths[i] - len(columns[i])), end="")
        print(" ", end="")
    print("|")

# Method untuk mengonversi data objek Film menjadi array string baris tabel
def printFilmRow(f: Film):
    # Menyusun data atribut film ke dalam bentuk array String
    rowData = [
        # Mengambil data ID, Judul, dan Genre Film
        f.getIdFilm(),
        f.getJudul(),
        f.getGenre(),
        str(f.getDurasiMenit()),  # Mengonversi durasi ke String
        f"{f.getRating():.1f}"    # Memformat rating ke format 1 angka desimal
    ]
    printRow(rowData)  # Mencetak data baris film

# Method untuk menjalankan fungsi Tambah Data (Create)
def tambahData():
    print(BOLD + CYAN + "\n================ TAMBAH DATA FILM ================" + RESET)

    while True:  # Loop validasi ketersediaan ID
        idFilm = inputString("  Masukkan ID Film                : ", None)  # Meminta input ID Film
        if findIndexById(idFilm) == -1:
            break  # Keluar loop jika ID belum digunakan
        print(RED + "  [ERROR] ID Film sudah digunakan! Gunakan ID lain." + RESET)  # Error jika ID duplikat

    # Input judul, genre, durasi, dan rating film
    judul = inputString("  Masukkan Judul Film             : ", None)
    genre = inputString("  Masukkan Genre Film             : ", None)
    durasi = inputInt("  Masukkan Durasi (menit)         : ", None)
    rating = inputRating("  Masukkan Rating Film (0.0-10.0) : ", None)

    daftarFilm.append(Film(idFilm, judul, genre, durasi, rating))  # Menambahkan objek baru ke list
    print(GREEN + "  [SUCCESS] Data film berhasil ditambahkan!\n" + RESET)  # Pesan sukses

# Method untuk menampilkan seluruh data film (Read)
def tampilkanData():
    print(BOLD + CYAN + "\n================ DAFTAR DATA FILM ================" + RESET)
    if not daftarFilm:  # Cek apakah daftar film masih kosong
        print(YELLOW + "  Belum ada data film yang tersimpan.\n" + RESET)  # Pesan jika data kosong
        return  # Menghentikan eksekusi method

    resetColWidths()  # Menyesuaikan kembali ukuran kolom tabel
    printSeparator()  # Mencetak pembatas atas tabel
    printRow(HEADERS) # Mencetak header nama kolom
    printSeparator()  # Mencetak pembatas di bawah header
    for f in daftarFilm:  # Iterasi mencetak setiap objek film
        printFilmRow(f)  # Mencetak data per baris
    printSeparator()  # Mencetak pembatas bawah tabel
    print(CYAN + "  Total Film: " + str(len(daftarFilm)) + "\n" + RESET)  # Menampilkan total jumlah film

# Method untuk memperbarui data film berdasarkan ID (Update)
def updateData():
    print(BOLD + CYAN + "\n================ UPDATE DATA FILM ================" + RESET)
    if not daftarFilm:  # Memeriksa jika list kosong
        print(YELLOW + "  Data masih kosong! Tidak ada data yang bisa di-update.\n" + RESET)  # Peringatan data kosong
        return  # Keluar dari fungsi

    targetId = inputString("  Masukkan ID Film yang ingin di-update: ", None)  # Meminta ID target
    idx = findIndexById(targetId)  # Mencari posisi indeks objek

    if idx == -1:  # Jika ID tidak ditemukan dalam daftar
        print(RED + "  [ERROR] Film dengan ID '" + targetId + "' tidak ditemukan!\n" + RESET)  # Pesan kesalahan
        return  # Keluar dari fungsi

    filmLama = daftarFilm[idx]  # Mengambil referensi objek yang ditemukan
    print(YELLOW + "  Catatan: Tekan [ENTER] langsung jika tidak ingin mengubah nilai." + RESET)  # Petunjuk penggunaan

    while True:  # Perulangan validasi keunikan ID baru
        idBaru = inputString("  ID Baru [" + filmLama.getIdFilm() + "]       : ", filmLama.getIdFilm())  # Input ID baru
        # Lanjut jika ID sama dengan lama atau ID baru belum pernah dipakai
        if idBaru.lower() == filmLama.getIdFilm().lower() or findIndexById(idBaru) == -1:
            break  # Keluar dari loop jika valid
        print(RED + "  [ERROR] ID Film baru sudah digunakan oleh film lain!" + RESET)  # Error duplikat ID

    # Input judul, genre, durasi, dan rating baru
    judulBaru = inputString("  Judul Baru [" + filmLama.getJudul() + "]    : ", filmLama.getJudul())
    genreBaru = inputString("  Genre Baru [" + filmLama.getGenre() + "]    : ", filmLama.getGenre())
    durasiBaru = inputInt("  Durasi Baru (menit) [" + str(filmLama.getDurasiMenit()) + "]: ", str(filmLama.getDurasiMenit()))
    ratingBaru = inputRating("  Rating Baru [" + str(filmLama.getRating()) + "]  : ", str(filmLama.getRating()))

    # Mengubah nilai properti pada objek lama dengan data baru
    filmLama.setIdFilm(idBaru)
    filmLama.setJudul(judulBaru)
    filmLama.setGenre(genreBaru)
    filmLama.setDurasiMenit(durasiBaru)
    filmLama.setRating(ratingBaru)

    print(GREEN + "  [SUCCESS] Data film berhasil diperbarui!\n" + RESET)  # Pesan keberhasilan

# Method untuk menghapus data film berdasarkan ID (Delete)
def hapusData():
    print(BOLD + CYAN + "\n================ HAPUS DATA FILM ================" + RESET)
    if not daftarFilm:  # Memeriksa ketersediaan data
        print(YELLOW + "  Data masih kosong! Tidak ada data yang bisa dihapus.\n" + RESET)  # Peringatan data kosong
        return  # Keluar dari fungsi

    targetId = inputString("  Masukkan ID Film yang akan dihapus: ", None)  # Meminta input ID target
    idx = findIndexById(targetId)  # Mencari posisi ID dalam list

    if idx != -1:  # Jika ID ditemukan
        daftarFilm.pop(idx)  # Menghapus objek dari list berdasarkan indeks
        print(GREEN + "  [SUCCESS] Film dengan ID '" + targetId + "' berhasil dihapus!\n" + RESET)  # Pesan berhasil
    else:  # Jika ID tidak ditemukan
        print(RED + "  [ERROR] Film dengan ID '" + targetId + "' tidak ditemukan!\n" + RESET)  # Pesan gagal

# Method untuk mencari satu data film spesifik (Search)
def cariData():
    print(BOLD + CYAN + "\n================ CARI DATA FILM ================" + RESET)
    if not daftarFilm:  # Memeriksa ketersediaan data
        print(YELLOW + "  Data masih kosong!\n" + RESET)  # Peringatan data kosong
        return  # Keluar dari fungsi

    targetId = inputString("  Masukkan ID Film yang dicari: ", None)  # Input ID yang ingin dicari
    idx = findIndexById(targetId)  # Mencari indeks ID

    if idx != -1:  # Jika data ditemukan
        print(GREEN + "  [SUCCESS] Data film ditemukan!\n" + RESET)  # Pesan sukses
        resetColWidths()  # Menghitung lebar kolom
        printSeparator()  # Pembatas atas
        printRow(HEADERS) # Header tabel
        printSeparator()  # Pembatas tengah
        printFilmRow(daftarFilm[idx])  # Mencetak data film yang dicari
        printSeparator()  # Pembatas bawah
        print()  # Baris kosong
    else:  # Jika data tidak ditemukan
        print(RED + "  [ERROR] Film dengan ID '" + targetId + "' tidak ditemukan!\n" + RESET)  # Pesan gagal

# Method untuk menampilkan daftar pilihan menu utama
def tampilkanMenu():
    print(BOLD + CYAN + "+====================================================+")
    print("|           SISTEM MANAJEMEN DATA FILM               |")
    print("+====================================================+" + RESET)
    print("  1. Tambah Data Film (Insert)")
    print("  2. Tampilkan Semua Data Film (Show)")
    print("  3. Update Data Film (Update)")
    print("  4. Hapus Data Film (Delete)")
    print("  5. Cari Data Film (Search)")
    print("  6. Keluar")
    print(BOLD + CYAN + "+====================================================+" + RESET)

# Main Method sebagai titik awal jalannya program Python
def main():
    berjalan = True  # Penanda/flag status perulangan

    while berjalan:  # Perulangan utama
        tampilkanMenu()  # Menampilkan menu opsi
        pilihan = input(BOLD + "  Pilih menu [1-6]: " + RESET).strip()  # Membaca masukan pilihan pengguna

        match pilihan:  # Mengarahkan eksekusi program berdasarkan input pengguna
            case "1":  # Jika opsi 1, maka memanggil fungsi tambahData
                tambahData()
            case "2":  # Jika opsi 2, maka memanggil fungsi tampilkanData
                tampilkanData()
            case "3":  # Jika opsi 3, maka memanggil fungsi updateData
                updateData()
            case "4":  # Jika opsi 4, maka memanggil fungsi hapusData
                hapusData()
            case "5":  # Jika opsi 5, maka memanggil fungsi cariData
                cariData()
            case "6":  # Jika opsi 6, maka loop berhenti
                print(GREEN + "\n  Terima kasih telah menggunakan sistem film!\n" + RESET)  # Pesan keluar
                berjalan = False  # Mengubah flag menjadi False untuk menghentikan loop
            case _:  # Jika masukan selain 1-6
                print(RED + "\n  [ERROR] Pilihan menu tidak valid. Silakan pilih 1-6.\n" + RESET)


# Memeriksa apakah file ini dijalankan secara langsung sebagai program utama,
# bukan diimpor sebagai modul/library oleh file lain
if __name__ == "__main__":
    main()