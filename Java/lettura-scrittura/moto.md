**Esercitazione Java: Lettura di un file CSV e Generazione di un file HTML con Tabella**

In questo esercizio, dovrai leggere un file `.csv` contenente un elenco di motociclette e produrre un file HTML che visualizzi i dati in una tabella strutturata. Segui i passaggi riportati di seguito per completare l'esercitazione.

### Requisiti

1. Il file `.csv` è organizzato nel seguente formato (separatore: virgola):

   ```
   Marca, Modello, Cilindrata (cc), Prezzo (€)
   Harley-Davidson, Iron 883, 883, 10500
   Yamaha, MT-07, 689, 7500
   ...
   ```

2. La prima riga del file contiene i titoli delle colonne.

### Obiettivi

1. **Leggere il file `.csv`**: Usa Java per leggere il file e processare i dati.
2. **Estrarre e Memorizzare i Dati**: Memorizza ogni riga del file CSV in una struttura dati adatta (ad esempio, una lista di oggetti o un array).
3. **Generare il File HTML**:
   - Crea un file HTML.
   - Usa i dati estratti per costruire una tabella HTML, includendo una riga di intestazione e una riga per ciascun elemento del file `.csv`.
4. **Esportare l'Output**: Salva l'output come `output.html`.

### Specifiche della Tabella HTML

- La tabella deve includere una riga di intestazione con i titoli: "Marca," "Modello," "Cilindrata (cc)," e "Prezzo (€)".
- Ogni riga successiva deve rappresentare una motocicletta con le informazioni lette dal file `.csv`.

### Suggerimenti

- Usa `BufferedReader` oppure `Scanner` per leggere il file `.csv` riga per riga.
- Dividi ogni riga del CSV utilizzando il separatore di colonna (virgola).
- Usa una `FileWriter` per scrivere l’output in HTML.
- Ricorda di gestire eventuali eccezioni per evitare problemi con la lettura o scrittura di file.

### Obiettivo Finale

Alla fine dell’esercitazione, il tuo programma dovrà generare un file `output.html` che visualizzi i dati in una tabella HTML ben formattata, simile a questa:

```html
<table>
   <tr>
      <th>Marca</th>
      <th>Modello</th>
      <th>Cilindrata (cc)</th>
      <th>Prezzo (€)</th>
   </tr>
   <tr>
      <td>Harley-Davidson</td>
      <td>Iron 883</td>
      <td>883</td>
      <td>10500</td>
   </tr>
   <!-- Altri dati -->
</table>
```

