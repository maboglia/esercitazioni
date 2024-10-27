**Esercitazione Java: Lettura di un file CSV di Libri e Generazione di un file HTML con Tabella**

In questo esercizio, dovrai creare un programma in Java che legge un file `.csv` contenente un elenco di libri e genera un file HTML per visualizzare questi dati in una tabella.

### Requisiti

1. Il file `.csv` è strutturato con il seguente formato (separatore: virgola):

   ```
   Titolo, Autore, Pagine, Editore, Prezzo (€)
   Il vecchio e il mare, Ernest Hemingway, 127, Mondadori, 9.90
   Orgoglio e pregiudizio, Jane Austen, 279, Rizzoli, 12.50
   Il signore degli anelli, J.R.R. Tolkien, 1216, Bompiani, 45.00
   ...
   ```

2. La prima riga del file contiene i titoli delle colonne.

### Obiettivi

1. **Lettura del file `.csv`**: Utilizza Java per leggere il file `.csv` e ottenere i dati.
2. **Memorizzazione Dati**: Salva ciascuna riga in una struttura dati adeguata, come una lista di oggetti o un array.
3. **Creazione del File HTML**:
   - Crea un file HTML in cui i dati sono visualizzati in una tabella.
   - Aggiungi una riga di intestazione con i titoli delle colonne e una riga per ciascun libro.
4. **Output**: Salva il file come `libri_output.html`.

### Specifiche della Tabella HTML

- La tabella deve includere una riga di intestazione con i titoli: "Titolo," "Autore," "Pagine," "Editore," e "Prezzo (€)".
- Ogni riga successiva rappresenta un libro, con i dati letti dal file `.csv`.

### Suggerimenti

- Usa `BufferedReader` per leggere il file riga per riga.
- Per separare i dati in ogni riga, utilizza la virgola come delimitatore.
- Per scrivere l’HTML, utilizza `FileWriter` e inserisci ciascun dato all'interno della tabella.
- Gestisci le eccezioni per assicurarti che il programma possa leggere e scrivere i file correttamente.

### Obiettivo Finale

Alla fine, il tuo programma dovrà generare un file `libri_output.html` con una tabella HTML che presenta i dati dei libri in modo simile a quanto segue:

```html
<table>
   <tr>
      <th>Titolo</th>
      <th>Autore</th>
      <th>Pagine</th>
      <th>Editore</th>
      <th>Prezzo (€)</th>
   </tr>
   <tr>
      <td>Il vecchio e il mare</td>
      <td>Ernest Hemingway</td>
      <td>127</td>
      <td>Mondadori</td>
      <td>9.90</td>
   </tr>
   <tr>
      <td>Orgoglio e pregiudizio</td>
      <td>Jane Austen</td>
      <td>279</td>
      <td>Rizzoli</td>
      <td>12.50</td>
   </tr>
   <!-- Altri dati -->
</table>
```
