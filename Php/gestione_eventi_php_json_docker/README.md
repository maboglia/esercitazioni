# **Titolo esercitazione: "Gestione Eventi" (CRUD con PHP + JSON + File + Sessioni)**

#### **Obiettivo didattico**

Sviluppare una mini-app PHP standalone (senza database) per la gestione di eventi (es. corsi, seminari, workshop), con funzionalità di **inserimento, modifica, cancellazione e visualizzazione**. I dati sono memorizzati in un **file JSON**. Si usano **sessioni PHP** per tracciare l'utente connesso e il numero di operazioni effettuate.

---

### **Competenze attivate**

* Manipolazione di array e file JSON
* Gestione sessioni PHP
* Validazione e gestione form
* Organizzazione codice in moduli/funzioni
* Separazione logica e presentazione (HTML/PHP)
* Debugging e gestione errori

---

### **Struttura proposta**

#### 1. **Introduzione e setup iniziale (30 min)**

* Creazione progetto base
* File `index.php`, struttura cartelle (`data`, `includes`, `views`)
* File JSON vuoto `data/events.json`
* File `functions.php` con funzioni di utilità

#### 2. **Funzionalità principali (3 ore)**

| Fase | Funzionalità      | Descrizione                                                                      |
| ---- | ----------------- | -------------------------------------------------------------------------------- |
| 1    | Elenco eventi     | `index.php` legge e mostra gli eventi da `events.json`                           |
| 2    | Aggiungi evento   | Form con: titolo, descrizione, data evento                                       |
| 3    | Modifica evento   | Form precompilato con dati da `events.json`                                      |
| 4    | Cancella evento   | Conferma ed eliminazione da JSON                                                 |
| 5    | Sessioni          | Tracciamento operazioni CRUD e utente simulato (es. via parametro `?user=alice`) |
| 6    | Messaggi feedback | Messaggi di successo/errore tramite `$_SESSION['flash']`                         |

#### 3. **Test e miglioramenti (30 min)**

* Testare flusso CRUD completo
* Verifica scrittura JSON corretta
* Opzionale: ordinamento per data, ricerca per titolo

---

### **Suggerimenti tecnici**

#### File JSON (`data/events.json`)

```json
[
  {
    "id": 1,
    "title": "Workshop PHP",
    "description": "Introduzione a PHP moderno",
    "date": "2025-07-15"
  }
]
```

#### Esempio struttura file

* `index.php` – homepage e elenco
* `add.php` – form per inserimento
* `edit.php?id=1` – form modifica
* `delete.php?id=1` – eliminazione
* `functions.php` – funzioni: load\_events(), save\_events(), get\_event\_by\_id(), generate\_id()
* `session.php` – gestione sessioni e utente fittizio

---

### **Consegna finale**

* Codice funzionante con interfaccia minimale ma usabile
* Commenti nel codice
* File `.zip` con tutto il progetto

---

### **Extra (facoltativi)**

* Protezione base contro XSS
* Esportazione in CSV
* Visualizzazione eventi futuri (filtri)
* Uso di `date()` e `strtotime()` per date corrette

---

