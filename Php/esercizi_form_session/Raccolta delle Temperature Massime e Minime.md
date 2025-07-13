# 🧪 **Esercitazione PHP – Monitoraggio delle Temperature Massime e Minime**

## 🎯 Obiettivo

Realizzare un'applicazione web in PHP che consenta di **raccogliere** e **analizzare** i dati meteo relativi alle temperature **massime** e **minime** registrate da diverse stazioni meteorologiche.

Il progetto prevede:

* Una pagina per l’inserimento delle temperature.
* Una per la memorizzazione e gestione dei dati.
* Una pagina di riepilogo e analisi statistica.

---

## 🧾 **Requisiti funzionali**

### 1. 🔧 **Pagina di inserimento dati (form HTML + PHP)**

* L’utente può selezionare una **stazione meteorologica** da un menu a tendina.

* Può inserire la **temperatura massima** e la **temperatura minima** rilevate.

* La lista delle stazioni deve essere generata dinamicamente da un array PHP contenente:

  ```php
  ["Trento", "Milano", "Torino", "Firenze", "Bologna", "Roma", "Napoli", "Bari", "Messina"]
  ```

* Ogni invio del form registra **una sola rilevazione**.

* Il form deve utilizzare il metodo **GET**.

---

### 2. 💾 **Gestione dei dati in sessione**

* I dati inviati tramite form (stazione, temperatura max, temperatura min) devono essere **salvati nella sessione PHP**.
* Ogni rilevazione salvata deve contenere anche un **timestamp**, generato con la funzione `time()`.
* Tutti i dati restano disponibili per l’intera durata della sessione.

---

### 3. 📊 **Pagina di riepilogo e analisi**

* Per **ogni stazione meteorologica**, mostrare:

  * 🔺 La **temperatura massima più alta** rilevata **nelle ultime 24 ore**.
  * 🔻 La **media delle temperature minime**:

    * nelle **ultime 24 ore** (giornata corrente)
    * negli **ultimi 7 giorni**

* I dati vanno filtrati usando il **timestamp** rispetto al tempo attuale:

  * Giornata corrente = `time() - 24 * 60 * 60`
  * Ultima settimana = `time() - 7 * 24 * 60 * 60`

* Le stazioni vanno suddivise in **zone geografiche**:

  | Zona   | Stazioni               |
  | ------ | ---------------------- |
  | Nord   | Trento, Milano, Torino |
  | Centro | Firenze, Bologna, Roma |
  | Sud    | Napoli, Bari, Messina  |

* Per **ogni zona**, calcolare e mostrare la **media complessiva** delle temperature **massime** e **minime** su **tutti i dati disponibili**.

---

## 🔧 **Tecnologie e strumenti richiesti**

* HTML per la struttura del form e delle tabelle di riepilogo.
* PHP per la gestione dei dati e delle sessioni.
* Nessun database richiesto: i dati devono essere gestiti **in memoria**, tramite variabili di sessione.
* Nessun CSS richiesto, ma è possibile aggiungere uno stile base.

---

## 📌 **Note aggiuntive**

* Ogni pagina deve essere ben organizzata e mostrare messaggi chiari all’utente.
* Può essere utile creare una struttura di file simile a:

  ```
  temperature/
  ├── index.php        ← Pagina principale (riepilogo)
  ├── insert.php       ← Pagina con il form
  ├── store.php        ← Script che salva i dati in sessione
  └── utils.php        ← Funzioni riutilizzabili (es. filtri temporali, calcoli medi)
  ```

---

## 📝 **Compito dello studente**

* Realizzare il progetto rispettando le specifiche.
* Testare tutte le funzionalità con dati realistici.
* Documentare brevemente il funzionamento con commenti nel codice.

