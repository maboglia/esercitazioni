# Esercitazione: Elaborazione dei dati da file CSV in Java

## Obiettivo:
L'obiettivo di questa esercitazione è quello di praticare l'elaborazione dei dati da un file CSV utilizzando il linguaggio di programmazione Java. Imparerai a leggere un file CSV contenente una tabella di giochi elettronici, a estrarre i dati dalle righe del file, a creare oggetti corrispondenti ai giochi elettronici e infine ad elaborare tali dati per ottenere informazioni utili.

## Attività:
1. Analisi del formato del file CSV:
   - Analizza il file CSV fornito e identifica il separatore dei campi e il tipo di dati presenti in ciascuna colonna.

2. Implementazione della classe Game:
   - Completa l'implementazione della classe `Game` con i campi corrispondenti ai dati presenti nel file CSV e con un costruttore per inizializzare gli oggetti `Game`.

3. Lettura del file CSV:
   - Scrivi il codice per leggere il file CSV fornito, estrarre i dati dalle righe e creare oggetti `Game` utilizzando tali dati.

4. Elaborazione dei dati:
   - Scrivi codice per elaborare i dati dei giochi letti dal file CSV. Ad esempio, calcola statistiche come il numero di giochi per genere o il numero medio di giochi pubblicati in un determinato anno.

5. Visualizzazione dei risultati:
   - Stampare i risultati dell'elaborazione dei dati in un formato comprensibile, come output della console.

6. Gestione delle eccezioni:
   - Implementa la gestione delle eccezioni per gestire situazioni anomale durante la lettura del file CSV, come file non trovato o formati di riga non validi.

7. Testing:
   - Testa il tuo codice con diversi file CSV di input per assicurarti che sia in grado di gestire dati diversi e casi limite.

8. Ottimizzazione:
   - Discuti su come ottimizzare il codice per migliorare le prestazioni o rendere il codice più leggibile e manutenibile.

## Suggerimenti:
- Assicurati di comprendere completamente il formato del file CSV prima di scrivere il codice per leggerlo.
- Usa una struttura dati appropriata per memorizzare i giochi elettronici letti dal file CSV, come una lista o una mappa.
- Organizza il tuo codice in metodi separati per migliorare la leggibilità e la manutenibilità.
- Non dimenticare di gestire le eccezioni per evitare crash imprevisti del programma.

---

## Esempio di lettura file

Ecco un esempio di codice Java per leggere un file CSV contenente una tabella di giochi elettronici e elaborare i dati:

```java
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class GameDataReader {
    public static void main(String[] args) {
        String csvFile = "games.csv"; // Path al file CSV
        String line = "";
        String csvSeparator = "\t"; // Separatore dei campi nel file CSV

        List<Game> games = new ArrayList<>();

        try (BufferedReader br = new BufferedReader(new FileReader(csvFile))) {
            // Legge ogni riga del file CSV
            while ((line = br.readLine()) != null) {
                // Divide la riga in campi utilizzando il separatore
                String[] data = line.split(csvSeparator);

                // Crea un oggetto Game con i dati dalla riga
                Game game = new Game(data[0], data[1], data[2], data[3], Integer.parseInt(data[4]));
                
                // Aggiunge il gioco alla lista
                games.add(game);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }

        // Esempio di utilizzo dei dati letti
        for (Game game : games) {
            System.out.println(game.toString());
        }
    }

    // Classe per rappresentare un gioco
    static class Game {
        private String name;
        private String genre;
        private String publisher;
        private String originalPlatform;
        private int year;

        public Game(String name, String genre, String publisher, String originalPlatform, int year) {
            this.name = name;
            this.genre = genre;
            this.publisher = publisher;
            this.originalPlatform = originalPlatform;
            this.year = year;
        }

        @Override
        public String toString() {
            return "Game{" +
                    "name='" + name + '\'' +
                    ", genre='" + genre + '\'' +
                    ", publisher='" + publisher + '\'' +
                    ", originalPlatform='" + originalPlatform + '\'' +
                    ", year=" + year +
                    '}';
        }
    }
}
```

Assicurati di sostituire il valore di `csvFile` con il percorso corretto del tuo file CSV. Questo codice legge il file CSV, crea oggetti `Game` per ogni riga e li memorizza in una lista. Infine, stampa i dettagli di ciascun gioco.

---

### File csv di esempio

[games.csv](https://raw.githubusercontent.com/maboglia/ProgrammingResources/master/tabelle/games/games.csv)