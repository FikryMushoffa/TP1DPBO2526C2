// Class Film digunakan sebagai blueprint data objek film
public class Film {
    // Atribut private
    private String idFilm; // ID unik film
    private String judul; // judul film
    private String genre; // genre film
    private int durasiMenit; // durasi film dalam hitungan menit
    private float rating; // nilai rating film (skala 0.0 - 10.0)

    // Constructor tanpa parameter (meng-inisialisasi atribut dengan nilai default)
    public Film() {
        this.idFilm = ""; 
        this.judul = ""; 
        this.genre = ""; 
        this.durasiMenit = 0; 
        this.rating = 0.0f; 
    }

    // Constructor dengan parameter (meng-inisialisasi atribut sesuai input)
    public Film(String idFilm, String judul, String genre, int durasiMenit, float rating) {
        this.idFilm = idFilm; 
        this.judul = judul; 
        this.genre = genre; 
        this.durasiMenit = durasiMenit; 
        this.rating = rating; 
    }

    // Method getter untuk mengembalikan nilai idFilm
    public String getIdFilm() {
        return idFilm;
    }

    // Method setter untuk mengisi atau memperbarui nilai idFilm
    public void setIdFilm(String idFilm) {
        this.idFilm = idFilm;
    }

    // Method getter untuk mengembalikan nilai judul
    public String getJudul() {
        return judul;
    }

    // Method setter untuk mengisi atau memperbarui nilai judul
    public void setJudul(String judul) {
        this.judul = judul;
    }

    // Method getter untuk mengembalikan nilai genre
    public String getGenre() {
        return genre; 
    }

    // Method setter untuk mengisi atau memperbarui nilai genre
    public void setGenre(String genre) {
        this.genre = genre;
    }

    // Method getter untuk mengembalikan nilai durasiMenit
    public int getDurasiMenit() {
        return durasiMenit;
    }

    // Method setter untuk mengisi atau memperbarui nilai durasiMenit
    public void setDurasiMenit(int durasiMenit) {
        // Memeriksa apakah durasi bernilai positif
        if (durasiMenit > 0) {
            this.durasiMenit = durasiMenit; // Mengisi atau memperbarui jika valid
        }
    }

    // Method getter untuk mengembalikan nilai rating
    public float getRating() {
        return rating;
    }

    // Method setter untuk mengisi atau memperbarui nilai rating
    public void setRating(float rating) {
        // Memeriksa apakah rating berada pada rentang 0.0 hingga 10.0
        if (rating >= 0.0f && rating <= 10.0f) {
            this.rating = rating; // Mengisi atau memperbarui jika valid
        }
    }
}