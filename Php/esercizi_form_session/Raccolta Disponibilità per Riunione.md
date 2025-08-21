# 🧪 **Esercitazione PHP – Raccolta di Disponibilità per una Riunione**

## 🎯 Obiettivo

Progettare e sviluppare un'applicazione web in **PHP** che consenta di raccogliere le **disponibilità settimanali** di più partecipanti per organizzare una riunione. Il sistema deve memorizzare i dati durante la sessione utente e fornire un **riepilogo aggregato**.

---

## 🧾 **Requisiti funzionali**

### 1. 📝 **Pagina di inserimento delle disponibilità**

* L’utente inserisce il **proprio nome** tramite un campo di testo.

* Seleziona:

  * uno o più **giorni della settimana** da un menu a scelta multipla.
  * una o più **fasce orarie** da un altro menu a scelta multipla.

* Le opzioni sono predefinite e gestite da array PHP:

  ```php
  $giorni = ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì"];
  $fasce = ["9-11", "11-13", "14-16", "16-18"];
  ```

* Ogni invio del form **aggiorna le disponibilità** del partecipante nella sessione.

* Se lo stesso partecipante invia più volte il form, le **disponibilità vengono accumulate** (non sovrascritte).

* Il form deve usare il metodo **POST**.

---

### 2. 💾 **Gestione dei dati in sessione**

* I dati (nome, giorni, fasce orarie) devono essere **memorizzati nella sessione PHP** come struttura dati associativa.
* Per ogni partecipante, si conserva una lista di combinazioni giorno-fascia oraria.
* Il sistema deve verificare se il partecipante è già presente e in tal caso **aggiungere le nuove disponibilità** alle precedenti.

---

### 3. 📊 **Pagina di riepilogo**

* Deve generare una **tabella** che mostri, per ogni **combinazione giorno-fascia oraria**, **quante persone** sono disponibili.
* Individua e visualizza le **combinazioni con il massimo numero di disponibilità**.
* Se il numero massimo di partecipanti in una certa fascia non è pari al totale dei partecipanti, la pagina deve:

  * Mostrare un elenco dei **partecipanti assenti** in quella fascia.
* La lista dei partecipanti si basa **sui nomi inseriti tramite il form**.

---

## 🗂️ **Struttura consigliata dei file**

```
riunione/
├── index.php        ← Pagina con il form di inserimento
├── store.php        ← Script per salvare i dati nella sessione
├── riepilogo.php    ← Pagina che elabora e mostra il riepilogo
└── utils.php        ← Funzioni di supporto (es. aggregazioni, formattazioni)
```

---

## 🔧 **Tecnologie da utilizzare**

* HTML per l'interfaccia utente.
* PHP per la logica, la gestione della sessione e l’elaborazione dei dati.
* Metodo POST per l’invio del form.
* Nessun database: i dati devono essere gestiti **in memoria**, usando `$_SESSION`.

---

## 📌 **Compito dello studente**

* Progettare il form di inserimento usando `select` con attributo `multiple`.
* Implementare la logica per accumulare le disponibilità nella sessione.
* Produrre il riepilogo aggregato, evidenziando le fasce con maggior numero di disponibilità e i partecipanti assenti in tali fasce.
* Commentare il codice per spiegare le scelte implementative.

