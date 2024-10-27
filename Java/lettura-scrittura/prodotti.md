**Esercitazione Java: Lettura di un file CSV di Prodotti e Generazione di un file HTML con Tabella**

In questo esercizio, creerai un programma in Java che legge un file `.csv` contenente un elenco di prodotti e genera un file HTML per visualizzare questi dati in una tabella.

### Requisiti

1. Il file `.csv` è strutturato con il seguente formato (separatore: virgola):

   ```
   Nome,Descrizione Breve,Prezzo (€),Quantità
   Prodotto1,Descrizione breve di Prodotto1,12.99,10
   Prodotto2,Descrizione breve di Prodotto2,7.50,25
   Prodotto3,Descrizione breve di Prodotto3,20.00,5
   ...
   ```

2. La prima riga del file contiene i titoli delle colonne.

### Obiettivi

1. **Lettura del file `.csv`**: Utilizza Java per leggere il file `.csv` e ottenere i dati.
2. **Memorizzazione Dati**: Salva ciascuna riga in una struttura dati adeguata, come una lista di oggetti o un array.
3. **Creazione del File HTML**:
   - Crea un file HTML in cui i dati sono visualizzati in una tabella.
   - Aggiungi una riga di intestazione con i titoli delle colonne e una riga per ciascun prodotto.
4. **Output**: Salva il file come `prodotti_output.html`.

### Specifiche della Tabella HTML

- La tabella deve includere una riga di intestazione con i titoli: "Nome," "Descrizione Breve," "Prezzo (€)," e "Quantità".
- Ogni riga successiva rappresenta un prodotto, con i dati letti dal file `.csv`.

### Suggerimenti

- Usa `BufferedReader` per leggere il file riga per riga.
- Per separare i dati in ogni riga, utilizza la virgola come delimitatore.
- Per scrivere l’HTML, utilizza `FileWriter` e inserisci ciascun dato all'interno della tabella.
- Gestisci le eccezioni per assicurarti che il programma possa leggere e scrivere i file correttamente.

### Obiettivo Finale

Alla fine, il tuo programma dovrà generare un file `prodotti_output.html` con una tabella HTML che presenta i dati dei prodotti in modo simile a quanto segue:

```html
<table>
   <tr>
      <th>Nome</th>
      <th>Descrizione Breve</th>
      <th>Prezzo (€)</th>
      <th>Quantità</th>
   </tr>
   <tr>
      <td>Prodotto1</td>
      <td>Descrizione breve di Prodotto1</td>
      <td>12.99</td>
      <td>10</td>
   </tr>
   <tr>
      <td>Prodotto2</td>
      <td>Descrizione breve di Prodotto2</td>
      <td>7.50</td>
      <td>25</td>
   </tr>
   <!-- Altri dati -->
</table>
```
