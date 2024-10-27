**Esercitazione Java: Lettura di un file CSV di Ricette e Generazione di un file HTML con Tabella**

In questo esercizio, scriverai un programma in Java che legge un file `.csv` contenente un elenco di ricette e genera un file HTML con una tabella che mostra questi dati.

### Requisiti

1. Il file `.csv` è strutturato con il seguente formato (separatore: virgola):

   ```
   Ricetta,Ingredienti Principali
   Pasta al Pomodoro,Pasta, Pomodoro, Basilico, Olio
   Tiramisu,Mascapone, Caffè, Savoiardi, Cacao
   Risotto alla Zucca,Zucca, Riso, Brodo Vegetale, Parmigiano
   ...
   ```

2. La prima riga del file contiene i titoli delle colonne.

### Obiettivi

1. **Lettura del file `.csv`**: Usa Java per leggere il file `.csv` e ottenere i dati delle ricette.
2. **Memorizzazione Dati**: Salva ogni riga in una struttura dati appropriata (come una lista di oggetti o un array).
3. **Creazione del File HTML**:
   - Crea un file HTML con una tabella per visualizzare i dati.
   - Aggiungi una riga di intestazione con i titoli delle colonne e una riga per ciascuna ricetta.
4. **Output**: Salva il file come `ricette_output.html`.

### Specifiche della Tabella HTML

- La tabella HTML deve includere una riga di intestazione con i titoli: "Ricetta" e "Ingredienti Principali".
- Ogni riga successiva rappresenta una ricetta, con i dati letti dal file `.csv`.

### Suggerimenti

- Usa `BufferedReader` per leggere il file `.csv` riga per riga.
- Usa la virgola come delimitatore per separare i dati in ogni riga.
- Per scrivere il file HTML, utilizza `FileWriter` e organizza i dati in una tabella HTML.
- Gestisci le eccezioni per assicurarti che il programma possa leggere e scrivere i file senza errori.

### Obiettivo Finale

Alla fine, il tuo programma dovrà generare un file `ricette_output.html` con una tabella HTML che presenta i dati delle ricette come illustrato:

```html
<table>
   <tr>
      <th>Ricetta</th>
      <th>Ingredienti Principali</th>
   </tr>
   <tr>
      <td>Pasta al Pomodoro</td>
      <td>Pasta, Pomodoro, Basilico, Olio</td>
   </tr>
   <tr>
      <td>Tiramisu</td>
      <td>Mascapone, Caffè, Savoiardi, Cacao</td>
   </tr>
   <!-- Altri dati -->
</table>
```
