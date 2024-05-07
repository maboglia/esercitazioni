# **Esercitazione: Creazione di una Playlist da un File di Testo di Canzoni in Java**

**Introduzione:**
In questa esercitazione, impareremo a creare un'applicazione Java che consente agli utenti di creare una playlist utilizzando le informazioni delle canzoni memorizzate in un file di testo. Utilizzeremo le basi della manipolazione dei file in Java per leggere le informazioni delle canzoni da un file di testo e genereremo un file HTML che rappresenta la playlist.

**Requisiti:**

1. Conoscenza di base della programmazione Java.
2. Comprensione di come leggere e scrivere file in Java.
3. IDE Java installato sul computer.

**Descrizione:**
L'applicazione Java che creeremo consentirà agli utenti di:

1. Specificare il percorso del file di testo contenente le informazioni delle canzoni (titolo, cantante, anno).
2. Leggere le informazioni delle canzoni dal file di testo.
3. Generare un file HTML che rappresenta la playlist utilizzando le informazioni delle canzoni lette.

**Passaggi:**

1. **Leggere le informazioni delle canzoni dal file di testo:**
   - Utilizzeremo le classi `FileReader` e `BufferedReader` per leggere il file di testo riga per riga.
   - Analizzeremo ogni riga per estrarre il titolo, il cantante e l'anno della canzone.

2. **Generare il file HTML della playlist:**
   - Utilizzeremo le classi `FileWriter` o `PrintWriter` per scrivere le informazioni delle canzoni in un file HTML.
   - Creeremo un file HTML valido con una struttura che rappresenta la playlist utilizzando le informazioni delle canzoni lette.

**Esempio di Struttura del File HTML di Output:**

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist</title>
</head>
<body>
    <h1>Playlist</h1>
    <ul>
        <li>Titol Canzone 1 - Cantante 1 (Anno 1)</li>
        <li>Titol Canzone 2 - Cantante 2 (Anno 2)</li>
        <!-- Altre canzoni -->
    </ul>
</body>
</html>
```

**Nota:**

- Assicurarsi di gestire eccezioni come `IOException` durante la lettura e la scrittura dei file.
- È possibile implementare funzionalità aggiuntive come la validazione delle informazioni delle canzoni o l'aggiunta di stili CSS al file HTML generato.

**Conclusioni:**
Con questa esercitazione, gli studenti avranno l'opportunità di praticare la manipolazione dei file in Java e la creazione di file HTML. Potranno anche esplorare ulteriori miglioramenti e funzionalità per espandere l'applicazione.


---

### Esempio lettura da file csv

```java
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class PlaylistCreator {

    public static void main(String[] args) {
        String csvFile = "elenco_canzoni.csv";
        List<Song> playlist = readCSV(csvFile);

        // Create a playlist for a specific genre (e.g., Rock)
        List<Song> rockPlaylist = createGenrePlaylist(playlist, "Rock");

        // Display the Rock playlist
        System.out.println("Rock Playlist:");
        for (Song song : rockPlaylist) {
            System.out.println(song.getArtist() + " - " + song.getName() + " (" + song.getAlbum() + ")");
        }
    }

    private static List<Song> readCSV(String file) {
        List<Song> songs = new ArrayList<>();
        try (BufferedReader br = new BufferedReader(new FileReader(file))) {
            String line;
            while ((line = br.readLine()) != null) {
                String[] data = line.split(",");
                if (data.length >= 5) {
                    String name = data[0];
                    String artist = data[1];
                    String album = data[2];
                    String duration = data[3];
                    String genre = data[4];
                    songs.add(new Song(name, artist, album, duration, genre));
                }
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return songs;
    }

    private static List<Song> createGenrePlaylist(List<Song> songs, String genre) {
        List<Song> genrePlaylist = new ArrayList<>();
        for (Song song : songs) {
            if (song.getGenre().equalsIgnoreCase(genre)) {
                genrePlaylist.add(song);
            }
        }
        return genrePlaylist;
    }
}

class Song {
    private String name;
    private String artist;
    private String album;
    private String duration;
    private String genre;

    public Song(String name, String artist, String album, String duration, String genre) {
        this.name = name;
        this.artist = artist;
        this.album = album;
        this.duration = duration;
        this.genre = genre;
    }

    public String getName() {
        return name;
    }

    public String getArtist() {
        return artist;
    }

    public String getAlbum() {
        return album;
    }

    public String getDuration() {
        return duration;
    }

    public String getGenre() {
        return genre;
    }
}
```
