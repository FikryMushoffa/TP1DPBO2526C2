import java.util.ArrayList; // Mengimpor kelas ArrayList untuk struktur data dinamis
import java.util.Scanner; // Mengimpor kelas Scanner untuk membaca input dari keyboard

// Class Main sebagai kelas utama tempat jalannya program
public class Main {
    // ArrayList penampung objek Film sebagai database sementara di memori
    private static ArrayList<Film> daftarFilm = new ArrayList<>();
    // Objek Scanner untuk menerima masukan dari pengguna secara global
    private static Scanner scanner = new Scanner(System.in);

    // Array string penampung nama-nama header kolom tabel
    private static final String[] HEADERS = {"ID Film", "Judul Film", "Genre", "Durasi (Menit)", "Rating"}; // final agar nilainya terkunci dan tidak dapat diubah lagi sampai program selesai
    // Array integer untuk mengelola lebar relatif kolom tabel
    private static int[] colWidths = new int[5];

    // Kode ANSI 
    // final agar nilainya terkunci dan tidak dapat diubah lagi sampai program selesai
    public static final String RESET = "\033[0m"; // mereset format teks terminal
    public static final String RED = "\033[31m"; // warna merah
    public static final String GREEN = "\033[32m"; // warna hijau
    public static final String CYAN = "\033[36m"; // warna cyan
    public static final String YELLOW = "\033[33m"; // warna kuning
    public static final String BOLD = "\033[1m"; // teks cetak tebal

    // Method untuk menghitung ulang lebar kolom agar tampilan tabel pas dengan isi data
    private static void resetColWidths() {
        // Mengisi lebar awal berdasarkan panjang teks header masing-masing kolom 
        for (int i = 0; i < HEADERS.length; i++) {
            colWidths[i] = HEADERS[i].length(); // Menyesuaikan lebar awal kolom i
        }
        // Melakukan iterasi ke seluruh data film untuk mencari teks terpanjang dengan membandingkan lebar tiap kolom
        for (Film f : daftarFilm) {
            colWidths[0] = Math.max(colWidths[0], f.getIdFilm().length()); 
            colWidths[1] = Math.max(colWidths[1], f.getJudul().length()); 
            colWidths[2] = Math.max(colWidths[2], f.getGenre().length()); 
            colWidths[3] = Math.max(colWidths[3], String.valueOf(f.getDurasiMenit()).length()); 
            colWidths[4] = Math.max(colWidths[4], String.format("%.1f", f.getRating()).length()); 
        }
    }

    // Method pencari indeks objek film dalam ArrayList berdasarkan ID
    private static int findIndexById(String idFilm) {
        // Perulangan untuk memeriksa tiap elemen di daftarFilm
        for (int i = 0; i < daftarFilm.size(); i++) {
            // Membandingkan ID film tanpa membedakan huruf besar atau kecil
            if (daftarFilm.get(i).getIdFilm().equalsIgnoreCase(idFilm)) {
                return i; // Mengembalikan posisi indeks jika ID ditemukan
            }
        }
        return -1; // Mengembalikan nilai -1 jika ID tidak ditemukan
    }

    // Method pembantu input string dengan validasi tidak boleh kosong
    private static String inputString(String prompt, String defaultValue) {
        while (true) { // Perulangan terus menerus sampai dapat input yang valid
            System.out.print(prompt); // Menampilkan petunjuk masukan teks
            String input = scanner.nextLine().trim(); // Membaca baris input dan menghapus spasi di awal/akhir
            if (!input.isEmpty()) return input; // Mengembalikan teks jika input tidak kosong
            if (defaultValue != null) return defaultValue; // Mengembalikan nilai default jika disediakan
            System.out.println(RED + "  [ERROR] Input tidak boleh kosong!" + RESET); // Menampilkan peringatan error
        }
    }

    // Method pembantu input bilangan bulat dengan validasi nilai positif
    private static int inputInt(String prompt, String defaultValue) {
        while (true) { // Perulangan terus menerus sampai didapat angka valid
            System.out.print(prompt); // Menampilkan petunjuk masukan angka
            String input = scanner.nextLine().trim(); // Membaca input berupa teks
            // Memeriksa jika input kosong tetapi ada nilai default yang tersimpan
            if (input.isEmpty() && defaultValue != null) {
                return Integer.parseInt(defaultValue); // Mengonversi dan mengembalikan nilai default
            }
            try { // Mencoba melakukan konversi dari String ke int
                int val = Integer.parseInt(input); // Mengubah format string menjadi integer
                if (val > 0) return val; // Mengembalikan nilai jika angka lebih dari 0
                System.out.println(RED + "  [ERROR] Nilai harus bilangan bulat positif (lebih dari 0)!" + RESET); // Error jika angka <= 0
            } catch (NumberFormatException e) { // Menangkap exception jika input bukan berupa angka
                System.out.println(RED + "  [ERROR] Input harus berupa angka bulat!" + RESET); // Pesan kesalahan tipe data
            }
        }
    }

    // Method pembantu input rating dengan rentang validasi 0.0 - 10.0
    private static float inputRating(String prompt, String defaultValue) {
        while (true) { // Perulangan sampai didapatkan angka desimal yang valid
            System.out.print(prompt); // Menampilkan petunjuk masukan rating
            String input = scanner.nextLine().trim(); // Membaca input berupa teks
            // Memeriksa jika input kosong tetapi terdapat nilai default
            if (input.isEmpty() && defaultValue != null) {
                return Float.parseFloat(defaultValue); // Mengonversi dan mengembalikan nilai default float
            }
            try { // Mencoba mengonversi dari String ke float
                float val = Float.parseFloat(input); // Mengubah nilai menjadi float
                if (val >= 0.0f && val <= 10.0f) return val; // Mengembalikan nilai jika berada di rentang 0-10
                System.out.println(RED + "  [ERROR] Rating harus berada di rentang 0.0 - 10.0!" + RESET); // Error jika out of range
            } catch (NumberFormatException e) { // Menangkap exception jika input bukan desimal
                System.out.println(RED + "  [ERROR] Input harus berupa angka desimal (contoh: 8.5)!" + RESET); // Pesan kesalahan tipe
            }
        }
    }

    // Method untuk mencetak garis horizontal pembatas tabel
    private static void printSeparator() {
        for (int width : colWidths) { // Iterasi ke setiap lebar kolom
            System.out.print("+"); 
            for (int i = 0; i < width + 2; i++) System.out.print("-"); 
        }
        System.out.println("+"); 
    }

    // Method untuk mencetak satu baris teks pada tabel
    private static void printRow(String[] columns) {
        for (int i = 0; i < columns.length; i++) { // Perulangan sesuai jumlah kolom
            System.out.print("| " + columns[i]); 
            for (int j = 0; j < colWidths[i] - columns[i].length(); j++) System.out.print(" "); 
            System.out.print(" "); 
        }
        System.out.println("|"); 
    }

    // Method untuk mengonversi data objek Film menjadi array string baris tabel
    private static void printFilmRow(Film f) {
        // Menyusun data atribut film ke dalam bentuk array String
        String[] rowData = {
            // Mengambil data ID, Judul, dan Genre Film
            f.getIdFilm(), 
            f.getJudul(), 
            f.getGenre(), 
            String.valueOf(f.getDurasiMenit()), // Mengonversi durasi ke String
            String.format("%.1f", f.getRating()) // Memformat rating ke format 1 angka desimal
        };
        printRow(rowData); // Mencetak data baris film
    }

    // Method untuk menjalankan fungsi Tambah Data (Create)
    private static void tambahData() {
        System.out.println(BOLD + CYAN + "\n================ TAMBAH DATA FILM ================" + RESET); 
        
        String idFilm; // Deklarasi variabel penampung ID
        while (true) { // Loop validasi ketersediaan ID
            idFilm = inputString("  Masukkan ID Film                : ", null); // Meminta input ID Film
            if (findIndexById(idFilm) == -1) break; // Keluar loop jika ID belum digunakan
            System.out.println(RED + "  [ERROR] ID Film sudah digunakan! Gunakan ID lain." + RESET); // Error jika ID duplikat
        }

        // Input judul,genre, durasi, dan rating film
        String judul = inputString("  Masukkan Judul Film             : ", null); 
        String genre = inputString("  Masukkan Genre Film             : ", null); 
        int durasi = inputInt("  Masukkan Durasi (menit)         : ", null); 
        float rating = inputRating("  Masukkan Rating Film (0.0-10.0) : ", null); 

        daftarFilm.add(new Film(idFilm, judul, genre, durasi, rating)); // Menambahkan objek baru ke ArrayList
        System.out.println(GREEN + "  [SUCCESS] Data film berhasil ditambahkan!\n" + RESET); // Pesan sukses
    }

    // Method untuk menampilkan seluruh data film (Read)
    private static void tampilkanData() {
        System.out.println(BOLD + CYAN + "\n================ DAFTAR DATA FILM ================" + RESET);
        if (daftarFilm.isEmpty()) { // Cek apakah daftar film masih kosong
            System.out.println(YELLOW + "  Belum ada data film yang tersimpan.\n" + RESET); // Pesan jika data kosong
            return; // Menghentikan eksekusi method
        }

        resetColWidths(); // Menyesuaikan kembali ukuran kolom tabel
        printSeparator(); // Mencetak pembatas atas tabel
        printRow(HEADERS); // Mencetak header nama kolom
        printSeparator(); // Mencetak pembatas di bawah header
        for (Film f : daftarFilm) { // Iterasi mencetak setiap objek film
            printFilmRow(f); // Mencetak data per baris
        }
        printSeparator(); // Mencetak pembatas bawah tabel
        System.out.println(CYAN + "  Total Film: " + daftarFilm.size() + "\n" + RESET); // Menampilkan total jumlah film
    }

    // Method untuk memperbarui data film berdasarkan ID (Update)
    private static void updateData() {
        System.out.println(BOLD + CYAN + "\n================ UPDATE DATA FILM ================" + RESET);
        if (daftarFilm.isEmpty()) { // Memeriksa jika ArrayList kosong
            System.out.println(YELLOW + "  Data masih kosong! Tidak ada data yang bisa di-update.\n" + RESET); // Peringatan data kosong
            return; // Keluar dari fungsi
        }

        String targetId = inputString("  Masukkan ID Film yang ingin di-update: ", null); // Meminta ID target
        int idx = findIndexById(targetId); // Mencari posisi indeks objek

        if (idx == -1) { // Jika ID tidak ditemukan dalam daftar
            System.out.println(RED + "  [ERROR] Film dengan ID '" + targetId + "' tidak ditemukan!\n" + RESET); // Pesan kesalahan
            return; // Keluar dari fungsi
        }

        Film filmLama = daftarFilm.get(idx); // Mengambil referensi objek yang ditemukan
        System.out.println(YELLOW + "  Catatan: Tekan [ENTER] langsung jika tidak ingin mengubah nilai." + RESET); // Petunjuk penggunaan

        String idBaru; // Variabel tempat menampung ID baru
        while (true) { // Perulangan validasi keunikan ID baru
            idBaru = inputString("  ID Baru [" + filmLama.getIdFilm() + "]       : ", filmLama.getIdFilm()); // Input ID baru
            // Lanjut jika ID sama dengan lama atau ID baru belum pernah dipakai
            if (idBaru.equalsIgnoreCase(filmLama.getIdFilm()) || findIndexById(idBaru) == -1) {
                break; // Keluar dari loop jika valid
            }
            System.out.println(RED + "  [ERROR] ID Film baru sudah digunakan oleh film lain!" + RESET); // Error duplikat ID
        }

        // Input judul, genre, durasi, dan rating baru
        String judulBaru = inputString("  Judul Baru [" + filmLama.getJudul() + "]    : ", filmLama.getJudul()); 
        String genreBaru = inputString("  Genre Baru [" + filmLama.getGenre() + "]    : ", filmLama.getGenre()); 
        int durasiBaru = inputInt("  Durasi Baru (menit) [" + filmLama.getDurasiMenit() + "]: ", String.valueOf(filmLama.getDurasiMenit())); 
        float ratingBaru = inputRating("  Rating Baru [" + filmLama.getRating() + "]  : ", String.valueOf(filmLama.getRating())); 

        // Mengubah nilai properti pada objek lama dengan data baru
        filmLama.setIdFilm(idBaru); 
        filmLama.setJudul(judulBaru); 
        filmLama.setGenre(genreBaru); 
        filmLama.setDurasiMenit(durasiBaru); 
        filmLama.setRating(ratingBaru); 

        System.out.println(GREEN + "  [SUCCESS] Data film berhasil diperbarui!\n" + RESET); // Pesan keberhasilan
    }

    // Method untuk menghapus data film berdasarkan ID (Delete)
    private static void hapusData() {
        System.out.println(BOLD + CYAN + "\n================ HAPUS DATA FILM ================" + RESET);
        if (daftarFilm.isEmpty()) { // Memeriksa ketersediaan data
            System.out.println(YELLOW + "  Data masih kosong! Tidak ada data yang bisa dihapus.\n" + RESET); // Peringatan data kosong
            return; // Keluar dari fungsi
        }

        String targetId = inputString("  Masukkan ID Film yang akan dihapus: ", null); // Meminta input ID target
        int idx = findIndexById(targetId); // Mencari posisi ID dalam list

        if (idx != -1) { // Jika ID ditemukan
            daftarFilm.remove(idx); // Menghapus objek dari ArrayList berdasarkan indeks
            System.out.println(GREEN + "  [SUCCESS] Film dengan ID '" + targetId + "' berhasil dihapus!\n" + RESET); // Pesan berhasil
        } else { // Jika ID tidak ditemukan
            System.out.println(RED + "  [ERROR] Film dengan ID '" + targetId + "' tidak ditemukan!\n" + RESET); // Pesan gagal
        }
    }

    // Method untuk mencari satu data film spesifik (Search)
    private static void cariData() {
        System.out.println(BOLD + CYAN + "\n================ CARI DATA FILM ================" + RESET);
        if (daftarFilm.isEmpty()) { // Memeriksa ketersediaan data
            System.out.println(YELLOW + "  Data masih kosong!\n" + RESET); // Peringatan data kosong
            return; // Keluar dari fungsi
        }

        String targetId = inputString("  Masukkan ID Film yang dicari: ", null); // Input ID yang ingin dicari
        int idx = findIndexById(targetId); // Mencari indeks ID

        if (idx != -1) { // Jika data ditemukan
            System.out.println(GREEN + "  [SUCCESS] Data film ditemukan!\n" + RESET); // Pesan sukses
            resetColWidths(); // Menghitung lebar kolom
            printSeparator(); // Pembatas atas
            printRow(HEADERS); // Header tabel
            printSeparator(); // Pembatas tengah
            printFilmRow(daftarFilm.get(idx)); // Mencetak data film yang dicari
            printSeparator(); // Pembatas bawah
            System.out.println(); // Baris kosong
        } else { // Jika data tidak ditemukan
            System.out.println(RED + "  [ERROR] Film dengan ID '" + targetId + "' tidak ditemukan!\n" + RESET); // Pesan gagal
        }
    }

    // Method untuk menampilkan daftar pilihan menu utama
    private static void tampilkanMenu() {
        System.out.println(BOLD + CYAN + "+====================================================+"); 
        System.out.println("|           SISTEM MANAJEMEN DATA FILM               |"); 
        System.out.println("+====================================================+" + RESET); 
        System.out.println("  1. Tambah Data Film (Insert)"); 
        System.out.println("  2. Tampilkan Semua Data Film (Show)"); 
        System.out.println("  3. Update Data Film (Update)"); 
        System.out.println("  4. Hapus Data Film (Delete)"); 
        System.out.println("  5. Cari Data Film (Search)"); 
        System.out.println("  6. Keluar"); 
        System.out.println(BOLD + CYAN + "+====================================================+" + RESET); 
    }

    // Main Method sebagai titik awal jalannya program Java
    public static void main(String[] args) {
        boolean berjalan = true; // Penanda/flag status perulangan

        while (berjalan) { // Perulangan utama
            tampilkanMenu(); // Menampilkan menu opsi
            System.out.print(BOLD + "  Pilih menu [1-6]: " + RESET); // Meminta pengguna memilih menu
            String pilihan = scanner.nextLine().trim(); // Membaca masukan pilihan pengguna

            switch (pilihan) { // Mengarahkan eksekusi program berdasarkan input pengguna
                case "1": // Jika opsi 1, maka memanggil fungsi tambahData
                    tambahData(); 
                    break; 
                case "2": // Jika opsi 2, maka memanggil fungsi tampilkanData
                    tampilkanData(); 
                    break; 
                case "3": // Jika opsi 3, maka memanggil fungsi updateData
                    updateData(); 
                    break; 
                case "4": // Jika opsi 4, maka memanggil fungsi hapusData
                    hapusData(); 
                    break; 
                case "5": // Jika opsi 5, maka memanggil fungsi cariData
                    cariData(); 
                    break; 
                case "6": // Jika opsi 6, maka loop berhenti
                    System.out.println(GREEN + "\n  Terima kasih telah menggunakan sistem film!\n" + RESET); // Pesan keluar
                    berjalan = false; // Mengubah flag menjadi false untuk menghentikan loop
                    break; 
                default: // Jika masukan selain 1-6
                    System.out.println(RED + "\n  [ERROR] Pilihan menu tidak valid. Silakan pilih 1-6.\n" + RESET); // Pesan menu salah
            }
        }
        scanner.close(); // Menutup resource scanner setelah program selesai
    }
}