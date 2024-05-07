**Esercitazione PHP: Gestione di un Magazzino Prodotti**

In questa esercitazione, creeremo un semplice sistema per gestire un magazzino di prodotti utilizzando PHP. Immaginiamo di avere alcuni prodotti in magazzino e di voler monitorare le loro quantità e prezzi. Ecco come procedere:

1. **Creazione dei Prodotti**
   - Definiamo alcuni prodotti di esempio con i loro prezzi:
     - Prodotto 1: **Scarpe da Ginnastica Nike** - Prezzo: **$79.99**
     - Prodotto 2: **Maglietta a Maniche Corte** - Prezzo: **$24.99**
     - Prodotto 3: **Occhiali da Sole Polarizzati** - Prezzo: **$59.99**

2. **Struttura del Magazzino**
   - Creiamo un array associativo per rappresentare il magazzino. Ogni elemento dell'array avrà i seguenti campi:
     - `"nome"`: Nome del prodotto.
     - `"quantità"`: Quantità disponibile in magazzino.
     - `"prezzo"`: Prezzo unitario del prodotto.

3. **Aggiornamento delle Quantità**
   - Quando vendiamo un prodotto, diminuiamo la quantità disponibile nel magazzino.
   - Possiamo anche aggiungere nuovi prodotti al magazzino.

4. **Visualizzazione del Magazzino**
   - Mostreremo i prodotti presenti nel magazzino con le rispettive quantità e prezzi.
   - Calcoleremo il valore totale del magazzino sommando i prezzi dei prodotti moltiplicati per le quantità.

5. **Esempio di Codice PHP**
   ```php
   <?php
   // Definizione dei prodotti nel magazzino
   $magazzino = [
       ["nome" => "Scarpe da Ginnastica Nike", "quantità" => 20, "prezzo" => 79.99],
       ["nome" => "Maglietta a Maniche Corte", "quantità" => 15, "prezzo" => 24.99],
       ["nome" => "Occhiali da Sole Polarizzati", "quantità" => 10, "prezzo" => 59.99]
   ];

   // Calcolo del valore totale del magazzino
   $valoreTotale = 0;
   foreach ($magazzino as $prodotto) {
       $valoreTotale += $prodotto["quantità"] * $prodotto["prezzo"];
   }

   // Visualizzazione del magazzino
   echo "Magazzino Prodotti:\n";
   foreach ($magazzino as $prodotto) {
       echo "{$prodotto['nome']} (Quantità: {$prodotto['quantità']}) - Prezzo: \${$prodotto['prezzo']}\n";
   }
   echo "Valore Totale del Magazzino: \${$valoreTotale}\n";
   ?>
   ```

6. **Personalizzazione**
   - Puoi aggiungere altre funzionalità come la ricerca di prodotti, la modifica dei prezzi o la registrazione delle vendite.

---

¹[1][1]: [Esercizio Excel: Gestire Prodotti in Magazzino](https://www.informarsi.net/prodotti-magazzino/)
²[2][2]: [La Valutazione delle Rimanenze di Magazzino](https://www.dse.univr.it/documenti/OccorrenzaIns/matdid/matdid701144.pdf)
³[3][3]: [Rimanenze di Magazzino: Quali Sono e Come Si Valutano](https://farenumeri.it/rimanenze-di-magazzino/)
