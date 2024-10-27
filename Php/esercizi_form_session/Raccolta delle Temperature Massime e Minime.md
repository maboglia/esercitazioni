# Esercizio 7: Raccolta delle Temperature Massime e Minime

In questo esercizio, l'obiettivo è creare un servizio web per raccogliere e analizzare i dati relativi alle temperature massime e minime registrate da diverse stazioni meteorologiche. Il sistema consente di inserire i dati relativi alle temperature e di visualizzare statistiche su di esse. Le pagine richieste sono le seguenti:

### 1. **Pagina di inserimento delle temperature**
   - L'utente può selezionare il **nome della stazione meteorologica** da un menu a tendina, e inserire la **temperatura massima** e la **temperatura minima** registrata.
   - Il menu a tendina deve essere generato dinamicamente a partire da un array contenente i nomi delle stazioni: "Trento", "Milano", "Torino", "Firenze", "Bologna", "Roma", "Napoli", "Bari", "Messina".
   - Ogni invio del form consente di registrare una sola misura. Per registrare più misurazioni, l'utente dovrà inviare il form più volte nella stessa sessione.
   
### 2. **Pagina di raccolta dei dati**
   - I dati inseriti tramite il form (nome della stazione, temperatura massima, temperatura minima) devono essere memorizzati sul server. Ad ogni dato registrato, viene associato un **timestamp** (utilizzando la funzione `time()` che fornisce il numero di secondi dal 1 gennaio 1970 alle 00:00:00 GMT).
   - Tutte le temperature inserite vengono memorizzate e gestite per la stessa sessione di lavoro.

### 3. **Pagina di riepilogo**
   - La pagina visualizza, per ogni stazione, le seguenti informazioni:
     - **Temperatura massima più alta** registrata nella giornata corrente.
     - **Media delle temperature minime** registrate durante la giornata corrente e durante l'ultima settimana.
     - La giornata corrente è considerata a partire dal timestamp attuale meno `24*60*60` (ossia le ultime 24 ore), mentre l'ultima settimana parte dal timestamp attuale meno `7*24*60*60`.
   
   - Inoltre, le stazioni meteorologiche sono suddivise in zone:
     - **Nord**: "Trento", "Milano", "Torino".
     - **Centro**: "Firenze", "Bologna", "Roma".
     - **Sud**: "Napoli", "Bari", "Messina".
   
   - Per ciascuna zona, la pagina deve mostrare la media delle temperature massime e minime rilevate, calcolata su tutti i dati disponibili.

### Obiettivo:
Scrivere il form e le pagine di raccolta dati e riepilogo, utilizzando **HTML** e **PHP**, con l'uso del metodo **GET** per il form di inserimento.