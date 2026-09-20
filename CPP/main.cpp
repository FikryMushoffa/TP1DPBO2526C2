// Mengimpor library 
#include <iostream>  // Operasi input/output
#include <vector>    // Struktur data dinamis
#include <string>    // Manipulasi teks
#include <sstream>   // Pemformatan string
#include <iomanip>   // Pemformatan angka desimal
#include <algorithm> // Fungsi umum
#include <cctype>    // Penanganan karakter
#include "Film.cpp"  // Mengimpor kelas Film dari file Film.cpp

using namespace std;

// Vector penampung objek Film sebagai database sementara di memori
vector<Film> daftarFilm;

// Array string penampung nama-nama header kolom tabel
const string HEADERS[5] = {"ID Film", "Judul Film", "Genre", "Durasi (Menit)", "Rating"};
// Array integer untuk mengelola lebar relatif kolom tabel
int colWidths[5];

// Kode ANSI 
// const agar nilainya terkunci dan tidak dapat diubah lagi sampai program selesai
const string RESET = "\033[0m";  // mereset format teks terminal
const string RED = "\033[31m";    // warna merah
const string GREEN = "\033[32m";  // warna hijau
const string CYAN = "\033[36m";   // warna cyan
const string YELLOW = "\033[33m"; // warna kuning
const string BOLD = "\033[1m";    // teks cetak tebal

// Method pembantu untuk menghapus spasi di awal dan akhir string (trim)
string trim(const string& str) {
    size_t first = str.find_first_not_of(" \t\n\r");
    if (first == string::npos) return "";
    size_t last = str.find_last_not_of(" \t\n\r");
    return str.substr(first, (last - first + 1));
}

// Method pembantu membandingkan dua string tanpa membedakan huruf besar/kecil (equals ignore case)
bool equalsIgnoreCase(const string& str1, const string& str2) {
    if (str1.length() != str2.length()) return false;
    for (size_t i = 0; i < str1.length(); i++) {
        if (tolower(str1[i]) != tolower(str2[i])) return false;
    }
    return true;
}

// Method untuk menghitung ulang lebar kolom agar tampilan tabel pas dengan isi data
void resetColWidths() {
    // Mengisi lebar awal berdasarkan panjang teks header masing-masing kolom 
    for (int i = 0; i < 5; i++) {
        colWidths[i] = HEADERS[i].length(); // Menyesuaikan lebar awal kolom i
    }
    // Melakukan iterasi ke seluruh data film untuk mencari teks terpanjang dengan membandingkan lebar tiap kolom
    for (const Film& f : daftarFilm) {
        colWidths[0] = max(colWidths[0], (int)f.getIdFilm().length()); 
        colWidths[1] = max(colWidths[1], (int)f.getJudul().length()); 
        colWidths[2] = max(colWidths[2], (int)f.getGenre().length()); 
        colWidths[3] = max(colWidths[3], (int)to_string(f.getDurasiMenit()).length()); 
        
        stringstream ss;
        ss << fixed << setprecision(1) << f.getRating();
        colWidths[4] = max(colWidths[4], (int)ss.str().length()); 
    }
}

// Method pencari indeks objek film dalam ArrayList/vector berdasarkan ID
int findIndexById(string idFilm) {
    // Perulangan untuk memeriksa tiap elemen di daftarFilm
    for (int i = 0; i < (int)daftarFilm.size(); i++) {
        // Membandingkan ID film tanpa membedakan huruf besar atau kecil
        if (equalsIgnoreCase(daftarFilm[i].getIdFilm(), idFilm)) {
            return i; // Mengembalikan posisi indeks jika ID ditemukan
        }
    }
    return -1; // Mengembalikan nilai -1 jika ID tidak ditemukan
}

// Method pembantu input string dengan validasi tidak boleh kosong
string inputString(string prompt, string defaultValue = "") {
    while (true) { // Perulangan terus menerus sampai dapat input yang valid
        cout << prompt; // Menampilkan petunjuk masukan teks
        string input;
        getline(cin, input);
        input = trim(input); // Membaca baris input dan menghapus spasi di awal/akhir
        if (!input.empty()) return input; // Mengembalikan teks jika input tidak kosong
        if (!defaultValue.empty()) return defaultValue; // Mengembalikan nilai default jika disediakan
        cout << RED << "  [ERROR] Input tidak boleh kosong!" << RESET << endl; // Menampilkan peringatan error
    }
}

// Method pembantu input bilangan bulat dengan validasi nilai positif
int inputInt(string prompt, string defaultValue = "") {
    while (true) { // Perulangan terus menerus sampai didapat angka valid
        cout << prompt; // Menampilkan petunjuk masukan angka
        string input;
        getline(cin, input);
        input = trim(input); // Membaca input berupa teks
        // Memeriksa jika input kosong tetapi ada nilai default yang tersimpan
        if (input.empty() && !defaultValue.empty()) {
            return stoi(defaultValue); // Mengonversi dan mengembalikan nilai default
        }
        try { // Mencoba melakukan konversi dari String ke int
            size_t pos;
            int val = stoi(input, &pos); // Mengubah format string menjadi integer
            if (pos == input.length()) { // Memastikan seluruh string dikonversi
                if (val > 0) return val; // Mengembalikan nilai jika angka lebih dari 0
                cout << RED << "  [ERROR] Nilai harus bilangan bulat positif (lebih dari 0)!" << RESET << endl; // Error jika angka <= 0
            } else {
                cout << RED << "  [ERROR] Input harus berupa angka bulat!" << RESET << endl; // Pesan kesalahan tipe data
            }
        } catch (...) { // Menangkap exception jika input bukan berupa angka
            cout << RED << "  [ERROR] Input harus berupa angka bulat!" << RESET << endl; // Pesan kesalahan tipe data
        }
    }
}

// Method pembantu input rating dengan rentang validasi 0.0 - 10.0
float inputRating(string prompt, string defaultValue = "") {
    while (true) { // Perulangan sampai didapatkan angka desimal yang valid
        cout << prompt; // Menampilkan petunjuk masukan rating
        string input;
        getline(cin, input);
        input = trim(input); // Membaca input berupa teks
        // Memeriksa jika input kosong tetapi terdapat nilai default
        if (input.empty() && !defaultValue.empty()) {
            return stof(defaultValue); // Mengonversi dan mengembalikan nilai default float
        }
        try { // Mencoba mengonversi dari String ke float
            size_t pos;
            float val = stof(input, &pos); // Mengubah nilai menjadi float
            if (pos == input.length()) { // Memastikan seluruh string dikonversi
                if (val >= 0.0f && val <= 10.0f) return val; // Mengembalikan nilai jika berada di rentang 0-10
                cout << RED << "  [ERROR] Rating harus berada di rentang 0.0 - 10.0!" << RESET << endl; // Error jika out of range
            } else {
                cout << RED << "  [ERROR] Input harus berupa angka desimal (contoh: 8.5)!" << RESET << endl; // Pesan kesalahan tipe
            }
        } catch (...) { // Menangkap exception jika input bukan desimal
            cout << RED << "  [ERROR] Input harus berupa angka desimal (contoh: 8.5)!" << RESET << endl; // Pesan kesalahan tipe
        }
    }
}

// Method untuk mencetak garis horizontal pembatas tabel
void printSeparator() {
    for (int width : colWidths) { // Iterasi ke setiap lebar kolom
        cout << "+"; 
        for (int i = 0; i < width + 2; i++) cout << "-"; 
    }
    cout << "+" << endl; 
}

// Method untuk mencetak satu baris teks pada tabel
void printRow(const string columns[]) {
    for (int i = 0; i < 5; i++) { // Perulangan sesuai jumlah kolom
        cout << "| " << columns[i]; 
        for (int j = 0; j < colWidths[i] - (int)columns[i].length(); j++) cout << " "; 
        cout << " "; 
    }
    cout << "|" << endl; 
}

// Method untuk mengonversi data objek Film menjadi array string baris tabel
void printFilmRow(const Film& f) {
    stringstream ss;
    ss << fixed << setprecision(1) << f.getRating();
    
    // Menyusun data atribut film ke dalam bentuk array String
    string rowData[5] = {
        // Mengambil data ID, Judul, dan Genre Film
        f.getIdFilm(), 
        f.getJudul(), 
        f.getGenre(), 
        to_string(f.getDurasiMenit()), // Mengonversi durasi ke String
        ss.str() // Memformat rating ke format 1 angka desimal
    };
    printRow(rowData); // Mencetak data baris film
}

// Method untuk menjalankan fungsi Tambah Data (Create)
void tambahData() {
    cout << BOLD << CYAN << "\n================ TAMBAH DATA FILM ================" << RESET << endl; 
    
    string idFilm; // Deklarasi variabel penampung ID
    while (true) { // Loop validasi ketersediaan ID
        idFilm = inputString("  Masukkan ID Film                : ", ""); // Meminta input ID Film
        if (findIndexById(idFilm) == -1) break; // Keluar loop jika ID belum digunakan
        cout << RED << "  [ERROR] ID Film sudah digunakan! Gunakan ID lain." << RESET << endl; // Error jika ID duplikat
    }

    // Input judul,genre, durasi, dan rating film
    string judul = inputString("  Masukkan Judul Film             : ", ""); 
    string genre = inputString("  Masukkan Genre Film             : ", ""); 
    int durasi = inputInt("  Masukkan Durasi (menit)         : ", ""); 
    float rating = inputRating("  Masukkan Rating Film (0.0-10.0) : ", ""); 

    daftarFilm.push_back(Film(idFilm, judul, genre, durasi, rating)); // Menambahkan objek baru ke vector
    cout << GREEN << "  [SUCCESS] Data film berhasil ditambahkan!\n" << RESET << endl; // Pesan sukses
}

// Method untuk menampilkan seluruh data film (Read)
void tampilkanData() {
    cout << BOLD << CYAN << "\n================ DAFTAR DATA FILM ================" << RESET << endl;
    if (daftarFilm.empty()) { // Cek apakah daftar film masih kosong
        cout << YELLOW << "  Belum ada data film yang tersimpan.\n" << RESET << endl; // Pesan jika data kosong
        return; // Menghentikan eksekusi method
    }

    resetColWidths(); // Menyesuaikan kembali ukuran kolom tabel
    printSeparator(); // Mencetak pembatas atas tabel
    printRow(HEADERS); // Mencetak header nama kolom
    printSeparator(); // Mencetak pembatas di bawah header
    for (const Film& f : daftarFilm) { // Iterasi mencetak setiap objek film
        printFilmRow(f); // Mencetak data per baris
    }
    printSeparator(); // Mencetak pembatas bawah tabel
    cout << CYAN << "  Total Film: " << daftarFilm.size() << "\n" << RESET << endl; // Menampilkan total jumlah film
}

// Method untuk memperbarui data film berdasarkan ID (Update)
void updateData() {
    cout << BOLD << CYAN << "\n================ UPDATE DATA FILM ================" << RESET << endl;
    if (daftarFilm.empty()) { // Memeriksa jika vector kosong
        cout << YELLOW << "  Data masih kosong! Tidak ada data yang bisa di-update.\n" << RESET << endl; // Peringatan data kosong
        return; // Keluar dari fungsi
    }

    string targetId = inputString("  Masukkan ID Film yang ingin di-update: ", ""); // Meminta ID target
    int idx = findIndexById(targetId); // Mencari posisi indeks objek

    if (idx == -1) { // Jika ID tidak ditemukan dalam daftar
        cout << RED << "  [ERROR] Film dengan ID '" << targetId << "' tidak ditemukan!\n" << RESET << endl; // Pesan kesalahan
        return; // Keluar dari fungsi
    }

    Film& filmLama = daftarFilm[idx]; // Mengambil referensi objek yang ditemukan
    cout << YELLOW << "  Catatan: Tekan [ENTER] langsung jika tidak ingin mengubah nilai." << RESET << endl; // Petunjuk penggunaan

    string idBaru; // Variabel tempat menampung ID baru
    while (true) { // Perulangan validasi keunikan ID baru
        idBaru = inputString("  ID Baru [" + filmLama.getIdFilm() + "]       : ", filmLama.getIdFilm()); // Input ID baru
        // Lanjut jika ID sama dengan lama atau ID baru belum pernah dipakai
        if (equalsIgnoreCase(idBaru, filmLama.getIdFilm()) || findIndexById(idBaru) == -1) {
            break; // Keluar dari loop jika valid
        }
        cout << RED << "  [ERROR] ID Film baru sudah digunakan oleh film lain!" << RESET << endl; // Error duplikat ID
    }

    stringstream ssRating;
    ssRating << fixed << setprecision(1) << filmLama.getRating();

    // Input judul, genre, durasi, dan rating baru
    string judulBaru = inputString("  Judul Baru [" + filmLama.getJudul() + "]    : ", filmLama.getJudul()); 
    string genreBaru = inputString("  Genre Baru [" + filmLama.getGenre() + "]    : ", filmLama.getGenre()); 
    int durasiBaru = inputInt("  Durasi Baru (menit) [" + to_string(filmLama.getDurasiMenit()) + "]: ", to_string(filmLama.getDurasiMenit())); 
    float ratingBaru = inputRating("  Rating Baru [" + ssRating.str() + "]  : ", ssRating.str()); 

    // Mengubah nilai properti pada objek lama dengan data baru
    filmLama.setIdFilm(idBaru); 
    filmLama.setJudul(judulBaru); 
    filmLama.setGenre(genreBaru); 
    filmLama.setDurasiMenit(durasiBaru); 
    filmLama.setRating(ratingBaru); 

    cout << GREEN << "  [SUCCESS] Data film berhasil diperbarui!\n" << RESET << endl; // Pesan keberhasilan
}

// Method untuk menghapus data film berdasarkan ID (Delete)
void hapusData() {
    cout << BOLD << CYAN << "\n================ HAPUS DATA FILM ================" << RESET << endl;
    if (daftarFilm.empty()) { // Memeriksa ketersediaan data
        cout << YELLOW << "  Data masih kosong! Tidak ada data yang bisa dihapus.\n" << RESET << endl; // Peringatan data kosong
        return; // Keluar dari fungsi
    }

    string targetId = inputString("  Masukkan ID Film yang akan dihapus: ", ""); // Meminta input ID target
    int idx = findIndexById(targetId); // Mencari posisi ID dalam list

    if (idx != -1) { // Jika ID ditemukan
        daftarFilm.erase(daftarFilm.begin() + idx); // Menghapus objek dari vector berdasarkan indeks
        cout << GREEN << "  [SUCCESS] Film dengan ID '" << targetId << "' berhasil dihapus!\n" << RESET << endl; // Pesan berhasil
    } else { // Jika ID tidak ditemukan
        cout << RED << "  [ERROR] Film dengan ID '" << targetId << "' tidak ditemukan!\n" << RESET << endl; // Pesan gagal
    }
}

// Method untuk mencari satu data film spesifik (Search)
void cariData() {
    cout << BOLD << CYAN << "\n================ CARI DATA FILM ================" << RESET << endl;
    if (daftarFilm.empty()) { // Memeriksa ketersediaan data
        cout << YELLOW << "  Data masih kosong!\n" << RESET << endl; // Peringatan data kosong
        return; // Keluar dari fungsi
    }

    string targetId = inputString("  Masukkan ID Film yang dicari: ", ""); // Input ID yang ingin dicari
    int idx = findIndexById(targetId); // Mencari indeks ID

    if (idx != -1) { // Jika data ditemukan
        cout << GREEN << "  [SUCCESS] Data film ditemukan!\n" << RESET << endl; // Pesan sukses
        resetColWidths(); // Menghitung lebar kolom
        printSeparator(); // Pembatas atas
        printRow(HEADERS); // Header tabel
        printSeparator(); // Pembatas tengah
        printFilmRow(daftarFilm[idx]); // Mencetak data film yang dicari
        printSeparator(); // Pembatas bawah
        cout << endl; // Baris kosong
    } else { // Jika data tidak ditemukan
        cout << RED << "  [ERROR] Film dengan ID '" << targetId << "' tidak ditemukan!\n" << RESET << endl; // Pesan gagal
    }
}

// Method untuk menampilkan daftar pilihan menu utama
void tampilkanMenu() {
    cout << BOLD << CYAN << "+====================================================+" << endl; 
    cout << "|           SISTEM MANAJEMEN DATA FILM               |" << endl; 
    cout << "+====================================================+" << RESET << endl; 
    cout << "  1. Tambah Data Film (Insert)" << endl; 
    cout << "  2. Tampilkan Semua Data Film (Show)" << endl; 
    cout << "  3. Update Data Film (Update)" << endl; 
    cout << "  4. Hapus Data Film (Delete)" << endl; 
    cout << "  5. Cari Data Film (Search)" << endl; 
    cout << "  6. Keluar" << endl; 
    cout << BOLD << CYAN << "+====================================================+" << RESET << endl; 
}

// Main Method sebagai titik awal jalannya program C++
int main() {
    bool berjalan = true; // Penanda/flag status perulangan

    while (berjalan) { // Perulangan utama
        tampilkanMenu(); // Menampilkan menu opsi
        cout << BOLD << "  Pilih menu [1-6]: " << RESET; // Meminta pengguna memilih menu
        string pilihan;
        getline(cin, pilihan); // Membaca masukan pilihan pengguna
        pilihan = trim(pilihan);

        if (pilihan == "1") { // Jika opsi 1, maka memanggil fungsi tambahData
            tambahData(); 
        } else if (pilihan == "2") { // Jika opsi 2, maka memanggil fungsi tampilkanData
            tampilkanData(); 
        } else if (pilihan == "3") { // Jika opsi 3, maka memanggil fungsi updateData
            updateData(); 
        } else if (pilihan == "4") { // Jika opsi 4, maka memanggil fungsi hapusData
            hapusData(); 
        } else if (pilihan == "5") { // Jika opsi 5, maka memanggil fungsi cariData
            cariData(); 
        } else if (pilihan == "6") { // Jika opsi 6, maka loop berhenti
            cout << GREEN << "\n  Terima kasih telah menggunakan sistem film!\n" << RESET << endl; // Pesan keluar
            berjalan = false; // Mengubah flag menjadi false untuk menghentikan loop
        } else { // Jika masukan selain 1-6
            cout << RED << "\n  [ERROR] Pilihan menu tidak valid. Silakan pilih 1-6.\n" << RESET << endl; // Pesan menu salah
        }
    }

    return 0;
}