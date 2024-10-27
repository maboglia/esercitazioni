**Esercitazione Java: Lettura di un file CSV e Generazione di un file HTML con Tabella**

In questo esercizio, dovrai leggere un file `.csv` contenente un elenco di automobili e produrre un file HTML che visualizzi i dati in una tabella strutturata. Segui i passaggi riportati di seguito per completare l'esercitazione.

### Requisiti

1. Il file `.csv` è organizzato nel seguente formato (separatore: virgola):

   ```
   Marca, Modello, Cilindrata (cc), Prezzo (€)
   Fiat, 500, 1200, 14500
   Volkswagen, Golf, 1600, 22000
   Toyota, Corolla, 1800, 20000
   Ford, Fiesta, 1400, 17000
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
- Ogni riga successiva deve rappresentare un’automobile con le informazioni lette dal file `.csv`.

### Suggerimenti

- Usa `BufferedReader` per leggere il file `.csv` riga per riga.
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
      <td>Fiat</td>
      <td>500</td>
      <td>1200</td>
      <td>14500</td>
   </tr>
   <tr>
      <td>Volkswagen</td>
      <td>Golf</td>
      <td>1600</td>
      <td>22000</td>
   </tr>
   <tr>
      <td>Toyota</td>
      <td>Corolla</td>
      <td>1800</td>
      <td>20000</td>
   </tr>
   <tr>
      <td>Ford</td>
      <td>Fiesta</td>
      <td>1400</td>
      <td>17000</td>
   </tr>
   <!-- Altri dati -->
</table>
```
