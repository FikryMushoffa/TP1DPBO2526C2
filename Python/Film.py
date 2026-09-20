# Class Film digunakan sebagai blueprint data objek film
class Film:
    # Constructor tanpa parameter dan dengan parameter (meng-inisialisasi atribut)
    def __init__(self, idFilm: str = "", judul: str = "", genre: str = "", durasiMenit: int = 0, rating: float = 0.0):
        # Atribut private
        self.__idFilm = idFilm          # ID unik film
        self.__judul = judul            # judul film
        self.__genre = genre            # genre film
        self.__durasiMenit = durasiMenit # durasi film dalam hitungan menit
        self.__rating = rating          # nilai rating film (skala 0.0 - 10.0)

    # Method getter untuk mengembalikan nilai idFilm
    def getIdFilm(self) -> str:
        return self.__idFilm

    # Method setter untuk mengisi atau memperbarui nilai idFilm
    def setIdFilm(self, idFilm: str):
        self.__idFilm = idFilm

    # Method getter untuk mengembalikan nilai judul
    def getJudul(self) -> str:
        return self.__judul

    # Method setter untuk mengisi atau memperbarui nilai judul
    def setJudul(self, judul: str):
        self.__judul = judul

    # Method getter untuk mengembalikan nilai genre
    def getGenre(self) -> str:
        return self.__genre

    # Method setter untuk mengisi atau memperbarui nilai genre
    def setGenre(self, genre: str):
        self.__genre = genre

    # Method getter untuk mengembalikan nilai durasiMenit
    def getDurasiMenit(self) -> int:
        return self.__durasiMenit

    # Method setter untuk mengisi atau memperbarui nilai durasiMenit
    def setDurasiMenit(self, durasiMenit: int):
        # Memeriksa apakah durasi bernilai positif
        if durasiMenit > 0:
            self.__durasiMenit = durasiMenit  # Mengisi atau memperbarui jika valid

    # Method getter untuk mengembalikan nilai rating
    def getRating(self) -> float:
        return self.__rating

    # Method setter untuk mengisi atau memperbarui nilai rating
    def setRating(self, rating: float):
        # Memeriksa apakah rating berada pada rentang 0.0 hingga 10.0
        if 0.0 <= rating <= 10.0:
            self.__rating = rating  # Mengisi atau memperbarui jika valid