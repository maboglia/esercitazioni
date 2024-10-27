# Esercizio 8: Raccolta Dati della Pressione Sanguigna

In questo esercizio, l'obiettivo è creare un servizio web per raccogliere e analizzare i dati relativi alla pressione sanguigna massima e minima di un gruppo di pazienti. Il sistema permette di inserire i dati della pressione e di visualizzare statistiche su di essi. Le pagine richieste sono le seguenti:

### 1. **Pagina di inserimento dei dati**
   - L'utente può selezionare il **nome del paziente** da un menu a tendina e inserire la **pressione sanguigna massima** e **minima**.
   - Il menu a tendina deve essere generato dinamicamente a partire da un array contenente i seguenti nomi di pazienti: "Mario", "Giuseppe", "Filippo", "Maria", "Rosa", "Emma", "Aldo", "Leonardo", "Marina".
   - Ogni invio del form consente di registrare una sola misura. Per registrare più misurazioni, l'utente dovrà inviare il form più volte nella stessa sessione.

### 2. **Pagina di raccolta dei dati**
   - I dati inseriti tramite il form (nome del paziente, pressione massima, pressione minima) devono essere memorizzati sul server. Ad ogni inserimento viene associato un **timestamp** utilizzando la funzione `time()`, che fornisce il numero di secondi dal 1 gennaio 1970 alle 00:00:00 GMT.
   - Le informazioni devono essere memorizzate in modo persistente all'interno della sessione corrente.

### 3. **Pagina di riepilogo**
   - La pagina visualizza, per ogni paziente, le seguenti informazioni:
     - **Pressione massima più alta** registrata.
     - **Differenza media tra pressione massima e minima** calcolata per le ultime **12 ore** e per l'ultima **giornata** (partendo rispettivamente da `12*60*60` e `24*60*60` secondi prima del timestamp attuale).
   
   - Inoltre, ogni paziente è associato a una **categoria**:
     - **M-60**: "Mario", "Giuseppe", "Leonardo".
     - **M-70**: "Filippo", "Aldo", "Marina".
     - **F-60**: "Maria", "Rosa".
     - **F-70**: "Emma".
   
   - Per ciascuna categoria, la pagina deve mostrare la **media delle pressioni massime e minime** rilevate per tutti i pazienti appartenenti a quella categoria, calcolata su tutti i dati disponibili.

### Obiettivo:
Scrivere il form e le due pagine di raccolta dati e riepilogo utilizzando **HTML** e **PHP**, con l'uso del metodo **POST** per il form di inserimento.