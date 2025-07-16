# 🧪 Esercitazione PHP: Tris Web

### 🎯 Obiettivo

Sviluppare un'applicazione web in **PHP** che permetta di giocare a **Tris (Tic-Tac-Toe)** in due giocatori umani, alternandosi al click, memorizzando lo stato di gioco nella sessione.

L'obiettivo è consolidare le competenze su:

* Manipolazione degli array
* Gestione dello stato con sessioni
* Invio dati via POST
* Logica condizionale e verifica di condizioni di vittoria
* Costruzione di interfacce utente dinamiche con HTML/CSS + PHP

---

### ⏱️ Tempo Stimato

**4 ore**
(con possibilità di estendere la consegna con bonus opzionali)

---

### 📄 Requisiti di base

Realizza una pagina web (`index.php`) che consenta:

1. **Visualizzazione della griglia 3x3** (9 celle cliccabili)
2. Alternanza dei turni tra giocatore **X** e giocatore **O**
3. Blocco delle celle già giocate
4. Rilevamento automatico della **vittoria** o del **pareggio**
5. Visualizzazione del messaggio di fine gioco
6. Pulsante per **ricominciare la partita**

---

### 📁 File richiesti

* `index.php` → logica principale
* `stile.css` → stile grafico della griglia e dei messaggi

---

### 💡 Suggerimenti Tecnici

* Utilizza un array di 9 elementi (`$_SESSION['board']`) per rappresentare la griglia.
* Ogni cella è un `<button>` dentro un `<form>` che invia la posizione cliccata.
* Utilizza `$_SESSION` per mantenere:

  * la griglia (`board`)
  * il turno corrente (`turno`)
  * lo stato del gioco (`fine`)
  * eventuale messaggio da mostrare

---

### ✅ Requisiti minimi (base)

* [ ] La griglia deve funzionare correttamente
* [ ] I turni devono alternarsi
* [ ] Le mosse non devono sovrascriversi
* [ ] Deve essere rilevata la vittoria
* [ ] Deve essere rilevato il pareggio
* [ ] Deve essere possibile resettare la partita

---

### 🧠 Bonus opzionali

Se completi la versione base, scegli uno o più dei seguenti miglioramenti:

1. 🔄 **Punteggio cumulativo** tra le partite (X: 2 | O: 1 | Pareggi: 1)
2. 🧠 **Modalità giocatore vs computer** (mossa casuale del bot)
3. 📝 **Cronologia mosse** (es: "X → 0", "O → 4", …)
4. 🧩 **Animazioni CSS** per il click o la vittoria
5. 💾 **Salvataggio partite** su file JSON

---

### 🔁 Modalità di consegna

* Crea una cartella con nome: `tris_nomecognome`
* All’interno inserisci:

  * `index.php`
  * `stile.css`
* Comprimi tutto in formato `.zip`
* Invia tramite la piattaforma / email / LMS del corso

---

### 📌 Valutazione

| Criterio                         | Punti  |
| -------------------------------- | ------ |
| Funzionalità base                | 10     |
| Corretta gestione della sessione | 4      |
| Interfaccia chiara               | 3      |
| Codice ordinato e commentato     | 3      |
| Bonus opzionale implementato     | +2     |
| **Totale**                       | **20** |

---

## Soluzione Base

