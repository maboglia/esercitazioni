**Esercitazione Java: Lettura di un file CSV di Utenti e Generazione di un file HTML con Tabella**

In questo esercizio, creerai un programma in Java che legge un file `.csv` contenente informazioni sugli utenti e genera un file HTML con una tabella per visualizzare questi dati.

### Requisiti

1. Il file `.csv` è strutturato come segue (separatore: virgola):

   ```
   Nome,Cognome,Data_nascita,Indirizzo,Comune
   Mario,Rossi,1990-05-10,Viale Roma,Milano
   Laura,Bianchi,1985-08-25,Via Milano,Roma
   Luca,Verdi,1978-01-15,Corso Italia,Napoli
   ...
   ```

2. La prima riga del file contiene i titoli delle colonne.

### Obiettivi

1. **Lettura del file `.csv`**: Scrivi il codice Java per leggere il file `.csv` e ottenere i dati degli utenti.
2. **Memorizzazione Dati**: Salva ogni riga in una struttura dati adeguata (come una lista di oggetti o un array).
3. **Creazione del File HTML**:
   - Crea un file HTML con una tabella per visualizzare i dati degli utenti.
   - Aggiungi una riga di intestazione con i titoli delle colonne e una riga per ogni utente.
4. **Output**: Salva il file come `utenti_output.html`.

### Specifiche della Tabella HTML

- La tabella HTML deve includere una riga di intestazione con i titoli delle colonne: "Nome," "Cognome," "Data_nascita," "Indirizzo," e "Comune."
- Ogni riga successiva rappresenta un utente, con i dati letti dal file `.csv`.

### Suggerimenti

- Usa `BufferedReader` per leggere il file `.csv` riga per riga.
- Utilizza la virgola come delimitatore per separare i dati in ogni riga.
- Per scrivere il file HTML, utilizza `FileWriter` e struttura i dati in una tabella HTML.
- Gestisci le eccezioni per assicurarti che il programma possa leggere e scrivere i file senza problemi.

### Obiettivo Finale

Il tuo programma genererà un file `utenti_output.html` contenente una tabella HTML con i dati degli utenti:

```html
<table>
   <tr>
      <th>Nome</th>
      <th>Cognome</th>
      <th>Data di nascita</th>
      <th>Indirizzo</th>
      <th>Comune</th>
   </tr>
   <tr>
      <td>Mario</td>
      <td>Rossi</td>
      <td>1990-05-10</td>
      <td>Viale Roma</td>
      <td>Milano</td>
   </tr>
   <tr>
      <td>Laura</td>
      <td>Bianchi</td>
      <td>1985-08-25</td>
      <td>Via Milano</td>
      <td>Roma</td>
   </tr>
   <!-- Altri dati -->
</table>
```
