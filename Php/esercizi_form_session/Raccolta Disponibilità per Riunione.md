# Esercizio 9: Raccolta Disponibilità per Riunione

L'obiettivo di questo esercizio è realizzare un servizio web per raccogliere le disponibilità di più partecipanti in vista dell'organizzazione di una riunione. Il sistema consente di gestire le preferenze di ogni partecipante in termini di giorni della settimana e fasce orarie. Sono richieste le seguenti pagine:

### 1. **Pagina di inserimento delle disponibilità**
   - L'utente può inserire il proprio nome e selezionare i giorni della settimana e le fasce orarie in cui è disponibile.
   - Sono presenti due menù a **scelta multipla**:
     - Il primo menù contiene i **giorni della settimana** (array predefinito: "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì").
     - Il secondo menù contiene le **fasce orarie** disponibili (array predefinito: "9-11", "11-13", "14-16", "16-18").
   - Il nome della persona viene inserito in un campo testuale.
   - Il form permette di specificare **più disponibilità** per ogni partecipante e ogni invio del form aggiorna le disponibilità memorizzate.
   - Le disponibilità vengono **aggiunte** se lo stesso partecipante invia il form più volte.

### 2. **Pagina di raccolta dei dati**
   - I dati inseriti tramite il form (nome, giorni della settimana, fasce orarie) vengono **memorizzati sul server** all'interno della stessa sessione.
   - Se un partecipante invia più di una richiesta, le disponibilità vengono **cumulative**, cioè aggiunte alle precedenti.

### 3. **Pagina di riepilogo**
   - La pagina stampa una **tabella** che riassume il numero di persone disponibili per ogni combinazione giorno-fascia oraria.
   - Viene visualizzato un riepilogo delle combinazioni giorno-fascia oraria per le quali è presente il **massimo numero di partecipanti disponibili**.
   - Se il massimo numero di persone disponibili in una fascia non coincide con il totale dei partecipanti, la pagina mostra un elenco delle **persone che non sono disponibili** in quelle fasce orarie.
   - La lista dei partecipanti è costituita da tutti i nomi inseriti attraverso il form.

### Obiettivo:
Scrivere il form e le due pagine (di raccolta dati e di riepilogo) utilizzando **HTML** e **PHP**, con l'uso del metodo **POST** per l'invio del form.