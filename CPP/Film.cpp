using namespace std;

// Class Film digunakan sebagai blueprint data objek film
class Film {
private:
    // Atribut private
    string idFilm; // ID unik film
    string judul; // judul film
    string genre; // genre film
    int durasiMenit; // durasi film dalam hitungan menit
    float rating; // nilai rating film (skala 0.0 - 10.0)

public:
    // Constructor tanpa parameter (meng-inisialisasi atribut dengan nilai default)
    Film() {
        this->idFilm = ""; 
        this->judul = ""; 
        this->genre = ""; 
        this->durasiMenit = 0; 
        this->rating = 0.0f; 
    }

    // Constructor dengan parameter (meng-inisialisasi atribut sesuai input)
    Film(string idFilm, string judul, string genre, int durasiMenit, float rating) {
        this->idFilm = idFilm; 
        this->judul = judul; 
        this->genre = genre; 
        this->durasiMenit = durasiMenit; 
        this->rating = rating; 
    }

    // Method getter untuk mengembalikan nilai idFilm
    string getIdFilm() const {
        return idFilm;
    }

    // Method setter untuk mengisi atau memperbarui nilai idFilm
    void setIdFilm(string idFilm) {
        this->idFilm = idFilm;
    }

    // Method getter untuk mengembalikan nilai judul
    string getJudul() const {
        return judul;
    }

    // Method setter untuk mengisi atau memperbarui nilai judul
    void setJudul(string judul) {
        this->judul = judul;
    }

    // Method getter untuk mengembalikan nilai genre
    string getGenre() const {
        return genre; 
    }

    // Method setter untuk mengisi atau memperbarui nilai genre
    void setGenre(string genre) {
        this->genre = genre;
    }

    // Method getter untuk mengembalikan nilai durasiMenit
    int getDurasiMenit() const {
        return durasiMenit;
    }

    // Method setter untuk mengisi atau memperbarui nilai durasiMenit
    void setDurasiMenit(int durasiMenit) {
        // Memeriksa apakah durasi bernilai positif
        if (durasiMenit > 0) {
            this->durasiMenit = durasiMenit; // Mengisi atau memperbarui jika valid
        }
    }

    // Method getter untuk mengembalikan nilai rating
    float getRating() const {
        return rating;
    }

    // Method setter untuk mengisi atau memperbarui nilai rating
    void setRating(float rating) {
        // Memeriksa apakah rating berada pada rentang 0.0 hingga 10.0
        if (rating >= 0.0f && rating <= 10.0f) {
            this->rating = rating; // Mengisi atau memperbarui jika valid
        }
    }

    // Destructor
    ~Film() {}
};