Le quattro esercitazioni coprono un’ampia gamma di **aspetti avanzati di PHP** in un contesto reale di sviluppo web. Di seguito trovi un elenco dettagliato degli **argomenti PHP affrontati**, suddivisi per **macro-area**:

---

### 🔐 **1. Sessioni e Autenticazione**

✔️ In tutte le esercitazioni:

* Avvio della sessione con `session_start()`
* Controllo accesso a pagine riservate
* Simulazione di login (confronto credenziali e gestione `$_SESSION`)

📚 **Concetti coinvolti:**

* Gestione stato utente
* Sicurezza base
* Protezione delle risorse

---

### 📝 **2. Gestione Form Web**

✔️ In tutte le esercitazioni:

* Invio dati via `POST`
* Ricezione e sanificazione input (`$_POST`, `strip_tags`, `htmlspecialchars`)
* Uso di `$_GET` per ID o parametri

📚 **Concetti coinvolti:**

* Validazione e sicurezza dati in ingresso
* Differenze tra `GET` e `POST`
* Navigazione tra form e script backend

---

### 🗃️ **3. CRUD su Database con PDO** (Esercitazione 1 + 4)

✔️ Nelle esercitazioni 1 (rubrica) e 4 (task manager):

* Connessione a MySQL tramite **PDO**
* `prepare()` + `execute()` per prevenire SQL injection
* Query `SELECT`, `INSERT`, `DELETE`, `UPDATE`
* Gestione dei risultati (`fetchAll`, `fetch`)

📚 **Concetti coinvolti:**

* Interazione sicura con database relazionali
* Astrazione DBMS-indipendente
* Architettura CRUD

---

### 📂 **4. Lettura e Scrittura File** (Esercitazione 2)

✔️ Funzioni utilizzate:

* `file_put_contents()`, `file_get_contents()`
* `glob()` per leggere i file presenti in una directory
* `basename()` per proteggere il percorso file

📚 **Concetti coinvolti:**

* Gestione input/output su file di testo
* Organizzazione contenuti su file system
* Sicurezza file path (evitare directory traversal)

---

### 🖼️ **5. Upload di File e Media** (Esercitazione 3)

✔️ Funzioni utilizzate:

* `$_FILES[]` per gestione upload
* `move_uploaded_file()` per salvare il file
* Controlli su **tipo, estensione, dimensione**
* Uso di `uniqid()` per evitare conflitti

📚 **Concetti coinvolti:**

* Sicurezza upload (tipo file, size limit)
* Gestione file temporanei
* Costruzione gallerie dinamiche

---

### 🌐 **6. API RESTful (HTTP + JSON)** (Esercitazione 4)

✔️ Logica in base a `$_SERVER['REQUEST_METHOD']`:

* `GET`, `POST`, `PUT`, `DELETE`
* Lettura corpo richieste JSON con `php://input`
* Risposta formattata in JSON con `json_encode()`

📚 **Concetti coinvolti:**

* Struttura API REST
* Manipolazione JSON in PHP
* Architettura stateless
* Corrispondenza tra metodi HTTP e azioni CRUD

---

### 🧰 **7. Funzioni PHP e Best Practices Trasversali**

✔️ Visibili in tutte le esercitazioni:

* Uso di `require` e separazione codice
* Funzioni di utilità (`basename`, `htmlspecialchars`, `nl2br`)
* Modularizzazione minima e riuso di script
* Gestione base degli errori

---

## 🎯 **Competenze finali verificate**

Al termine di queste esercitazioni, uno studente dovrebbe essere in grado di:

* Realizzare form web protetti da sessione
* Interagire con database MySQL usando PDO
* Leggere/scrivere file testuali lato server
* Implementare un sistema di upload immagini sicuro
* Costruire una REST API funzionante in PHP puro

---


### 🧪 **Esercitazione 1 — Gestione Rubrica Contatti (CRUD con PDO)**

**Obiettivo:** Realizzare una porzione di web app che consenta la gestione di una rubrica di contatti, utilizzando form HTML, sessioni PHP e PDO per il collegamento a un database MySQL.

**Requisiti funzionali:**

* Login con sessione PHP (mock, hardcoded: utente = admin, password = 1234).
* Form per **aggiungere un nuovo contatto**: nome, cognome, email, telefono.
* Visualizzazione in tabella dei contatti presenti nel database.
* Funzionalità di **modifica** e **cancellazione** contatto via form.
* Gestione degli errori e messaggi di successo tramite sessione.

**Requisiti tecnici:**

* Utilizzare PDO per connettersi al database.
* I dati devono essere salvati in una tabella `contatti` con chiave primaria auto-incrementale.
* Sanificazione dell’input (uso di `htmlspecialchars` e prepared statements).

---

## 🧪 **Esercitazione 1 – Rubrica Contatti (CRUD con PDO)**

### **Struttura del database (`rubrica.sql`)**

```sql
CREATE TABLE contatti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL
);
```

### **Dati mock**

```sql
INSERT INTO contatti (nome, cognome, email, telefono) VALUES
('Mario', 'Rossi', 'mario.rossi@example.com', '3331234567'),
('Luca', 'Bianchi', 'luca.bianchi@example.com', '3349876543'),
('Anna', 'Verdi', 'anna.verdi@example.com', '3351122334');
```

---

### 🧪 **Esercitazione 2 — Diario di Bordo (Lettura e Scrittura File)**

**Obiettivo:** Creare un'applicazione che consenta all’utente autenticato di scrivere e leggere pagine di diario salvate come file di testo, organizzate per data.

**Requisiti funzionali:**

* Login con sessione PHP (mock, hardcoded).
* Form per **scrivere una nuova voce di diario**: data (campo `date`) e testo.
* Il file deve essere salvato come `YYYY-MM-DD.txt` in una directory `diario/`.
* Visualizzazione elenco voci di diario con possibilità di cliccare e leggerne il contenuto.
* Visualizzazione messaggi di conferma/successo tramite sessione.

**Requisiti tecnici:**

* Lettura e scrittura dei file con funzioni come `file_put_contents()` e `file_get_contents()`.
* Creazione della directory `diario/` se non esistente.
* Sanitizzazione input utente.
* Gestione degli errori (es. file non accessibile).

---

## 🧪 **Esercitazione 2 – Diario di Bordo (File)**

### **File da leggere**

Salvato come: `diario/2025-06-30.txt`

### **Contenuto del file**

```
Giornata intensa. Ho completato l'esercizio sul CRUD con PDO e ho iniziato quello sul diario.
La gestione dei file con PHP è più semplice del previsto, ma bisogna stare attenti ai permessi.
Domani mi dedico all'upload!
```

---

### 🧪 **Esercitazione 3 — Gestione Immagini (Upload e Galleria)**

**Obiettivo:** Creare una galleria personale per l’utente autenticato, con possibilità di caricare immagini via form e visualizzarle in una griglia.

**Requisiti funzionali:**

* Login con sessione PHP.
* Form HTML per **caricare un’immagine** (`<input type="file">`).
* Le immagini devono essere salvate nella cartella `upload/` con nome univoco.
* Visualizzazione in pagina di tutte le immagini caricate (galleria con thumbnail).
* Validazione tipo e dimensione file.
* Messaggi di errore/successo in sessione.

**Requisiti tecnici:**

* Uso di `move_uploaded_file()` e `$_FILES`.
* Limitazione a file JPEG/PNG con max 2 MB.
* Creazione automatica della directory `upload/` se non esistente.
* Uso di `session_start()` e messaggi flash in sessione.

---

## 🧪 **Esercitazione 3 – Upload Immagini (Galleria)**

Questa esercitazione **non richiede un database**, ma puoi opzionalmente usarlo per tenere traccia delle immagini caricate (es. nome file e data upload).

### **Struttura opzionale (`upload_gallery.sql`)**

```sql
CREATE TABLE immagini (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_file VARCHAR(255) NOT NULL,
    data_upload DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### **Dati mock**

```sql
INSERT INTO immagini (nome_file) VALUES
('gatto.jpg'),
('tramonto.png'),
('montagna.jpeg');
```

Puoi anche popolare manualmente la cartella `upload/` con immagini placeholder.

---

### 🧪 **Esercitazione 4 — Servizio REST per Task Manager (CRUD API)**

**Obiettivo:** Realizzare un servizio RESTful in PHP che consenta la gestione di una lista di task (to-do list), con risposta in formato JSON.

**Requisiti funzionali:**

* Lato **frontend**: pagina HTML con form per aggiungere un task (titolo e descrizione), visualizzazione elenco e pulsanti "completa" e "elimina".
* Lato **backend**: un endpoint `api/tasks.php` che accetta richieste HTTP (GET, POST, PUT, DELETE) e restituisce JSON.
* Sessione PHP usata per mantenere l’utente loggato e per validare accesso alle API.

**Requisiti tecnici:**

* CRUD implementato usando `$_SERVER['REQUEST_METHOD']`.
* Dati salvati in tabella MySQL `tasks` con `id`, `titolo`, `descrizione`, `completato`.
* Le risposte JSON devono seguire un formato standard: `{ "status": "ok", "data": ... }` oppure `{ "status": "error", "message": ... }`.
* Sanitizzazione input e gestione errori.

---

## 🧪 **Esercitazione 4 – Task Manager (REST API)**

### **Struttura del database (`taskmanager.sql`)**

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(100) NOT NULL,
    descrizione TEXT,
    completato BOOLEAN DEFAULT FALSE
);
```

### **Dati mock**

```sql
INSERT INTO tasks (titolo, descrizione, completato) VALUES
('Preparare la presentazione', 'Slide per il corso di PHP avanzato', FALSE),
('Scrivere documentazione API', 'Endpoint REST per il task manager', TRUE),
('Controllare esercizi studenti', 'Verifica esercitazione su file e sessioni', FALSE);
```

---

**punti principali del codice PHP**

---

### ✅ **Esercitazione 1 – Rubrica Contatti (CRUD con PDO)**

**Obiettivo:** gestione contatti con inserimento, visualizzazione, modifica, eliminazione.

#### Punti principali

* **Connessione al DB (`connessione.php`)**
  Usa `PDO` per creare una connessione sicura al database MySQL, con gestione errori abilitata.

* **Login semplice (`login.php`)**
  Verifica credenziali hardcoded e avvia la sessione.

* **Protezione pagine con sessione**
  Tutte le pagine protette iniziano con:

  ```php
  session_start();
  if (!$_SESSION['logged']) die("Accesso negato");
  ```

* **Visualizzazione dati (`index.php`)**
  Esegue una `SELECT * FROM contatti` e stampa i dati in tabella HTML.

* **Inserimento (`add.php`)**
  Prepara e esegue una query `INSERT` con dati dal form, usando `$_POST`.

* **Cancellazione (`delete.php`)**
  Elimina un contatto passando `id` via `GET`, proteggendosi con `prepare()` e `execute()`.

---

### ✅ **Esercitazione 2 – Diario (Lettura/Scrittura File)**

**Obiettivo:** salvare e leggere testi quotidiani tramite file `.txt`.

#### Punti principali

* **Scrittura file (`scrivi.php`)**

  * Salva il contenuto del form in un file nominato `YYYY-MM-DD.txt`.
  * Usa `file_put_contents()` per scrivere.
  * Protegge l'input con `strip_tags()`.

* **Lettura file (`leggi.php`)**

  * Legge il contenuto con `file_get_contents()`.
  * Usa `basename()` per evitare path traversal.
  * Mostra il testo con `htmlspecialchars()` e `nl2br()`.

* **Elenco voci diario (`index.php`)**
  Usa `glob()` per trovare tutti i file `.txt` nella cartella `diario/`.

---

### ✅ **Esercitazione 3 – Upload Immagini (Galleria)**

**Obiettivo:** permettere l'upload di immagini e visualizzarle in galleria.

#### Punti principali

* **Upload immagini (`upload.php`)**

  * Costruisce un nome univoco con `uniqid()`.
  * Controlla l’estensione del file e la dimensione.
  * Usa `move_uploaded_file()` per salvare in `upload/`.

* **Visualizzazione (`index.php`)**

  * Legge i file presenti nella cartella `upload/` con `glob()` e `GLOB_BRACE`.
  * Mostra immagini usando `<img src="upload/..." />`.

---

### ✅ **Esercitazione 4 – API Task Manager (CRUD RESTful)**

**Obiettivo:** creare un'API REST per gestire task in formato JSON.

#### Punti principali

* **Header JSON:**

  ```php
  header("Content-Type: application/json");
  ```

* **Routing HTTP via `$_SERVER['REQUEST_METHOD']`**
  Il file `api/tasks.php` gestisce 4 casi:

  * `GET`: restituisce tutti i task in JSON.
  * `POST`: crea un nuovo task leggendo il body JSON.
  * `PUT`: aggiorna lo stato di completamento di un task.
  * `DELETE`: elimina un task.

* **Lettura body HTTP:**

  * `POST` usa `json_decode(file_get_contents("php://input"))`
  * `PUT` e `DELETE` usano `parse_str()` su `php://input`.

* **Output JSON strutturato:**
  Ogni risposta è nel formato:

  ```php
  echo json_encode(["status" => "ok", "data" => ...]);
  ```

---

Ecco una **griglia di valutazione** e una **checklist delle competenze** per le 4 esercitazioni PHP avanzate. 

---

## 🧾 **Griglia di Valutazione (max 100 punti)**

| **Area**                               | **Criterio**                                                       | **Punti** |
| -------------------------------------- | ------------------------------------------------------------------ | --------- |
| 🔐 **Sessione e Login**                | Autenticazione funzionante con sessione                            | 5         |
|                                        | Protezione pagine riservate                                        | 5         |
| 📝 **Gestione Form**                   | Corretta acquisizione dati da `$_POST`/`$_GET`                     | 5         |
|                                        | Validazione e sanificazione input                                  | 5         |
| 🗃️ **CRUD con PDO (Esercizio 1 e 4)** | Uso di `PDO`, `prepare()` e `execute()`                            | 10        |
|                                        | Gestione completa di almeno 3 operazioni CRUD                      | 10        |
|                                        | Visualizzazione dati da database                                   | 5         |
| 📂 **File I/O (Esercizio 2)**          | Scrittura sicura su file (nominazione, contenuto filtrato)         | 5         |
|                                        | Lettura corretta e visualizzazione contenuti                       | 5         |
| 🖼️ **Upload (Esercizio 3)**           | Controllo tipo, estensione e dimensione file                       | 5         |
|                                        | Uso di `move_uploaded_file()` e `uniqid()`                         | 5         |
| 🌐 **REST API (Esercizio 4)**          | Gestione metodi HTTP (`GET`, `POST`, `PUT`, `DELETE`)              | 10        |
|                                        | Input/Output JSON corretti                                         | 5         |
| 💡 **Buone pratiche e organizzazione** | Separazione logica dei file (`connessione.php`, `login.php`, ecc.) | 5         |
|                                        | Nomi file/variabili leggibili, codice commentato e strutturato     | 5         |

**Totale massimo:** ✅ **100 punti**

---

## ✅ **Checklist Competenze Acquisite**

### 🔐 Sessione e Sicurezza

* [ ] So creare e gestire una sessione PHP
* [ ] So limitare l’accesso a pagine tramite `$_SESSION`
* [ ] So implementare un login di base

### 📝 Form e Input

* [ ] So acquisire dati da un form via `$_POST`
* [ ] So usare `$_GET` per passare ID o parametri
* [ ] So sanificare input con `htmlspecialchars`, `strip_tags`

### 🗃️ Interazione con Database (PDO)

* [ ] So connettermi a un database MySQL con PDO
* [ ] So eseguire `SELECT`, `INSERT`, `UPDATE`, `DELETE`
* [ ] So usare query preparate per evitare SQL injection
* [ ] So ciclare e stampare dati da `fetchAll()`

### 📂 Gestione File

* [ ] So leggere file con `file_get_contents()`
* [ ] So scrivere file con `file_put_contents()`
* [ ] So elencare file in una directory (`glob()`)
* [ ] So proteggere i percorsi file con `basename()`

### 🖼️ Upload File

* [ ] So usare `$_FILES` per gestire un upload
* [ ] So salvare file con `move_uploaded_file()`
* [ ] So controllare tipo ed estensione file

### 🌐 RESTful API

* [ ] So distinguere tra `GET`, `POST`, `PUT`, `DELETE`
* [ ] So leggere il corpo della richiesta JSON (`php://input`)
* [ ] So restituire JSON con `json_encode()`
* [ ] So aggiornare e cancellare risorse via API

### 🧠 Buone pratiche

* [ ] So separare codice PHP in file riutilizzabili
* [ ] Uso nomi chiari per file e variabili
* [ ] Commento il codice nei punti complessi

