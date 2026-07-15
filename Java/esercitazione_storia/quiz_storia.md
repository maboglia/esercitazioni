# Esercitazione – Realizzare un motore di quiz sulla storia

## Obiettivo

Realizzare un'applicazione Java capace di generare automaticamente migliaia di domande di storia partendo da un archivio di eventi storici.

L'obiettivo dell'esercitazione **non è creare manualmente un elenco di domande**, ma progettare un sistema che sia in grado di costruirle dinamicamente.

L'applicazione dovrà leggere un archivio di eventi storici in formato JSON, scegliere casualmente uno degli eventi e utilizzare uno specifico modello di domanda (template) per creare il quiz.

Questo approccio permette di ottenere un numero elevatissimo di domande senza doverle scrivere una per una.

---

# Obiettivi didattici

Al termine dell'esercitazione lo studente sarà in grado di:

* leggere dati da un file JSON;
* rappresentare i dati tramite classi Java;
* progettare un modello orientato agli oggetti;
* utilizzare collezioni (`List`, `Map`, `Set`);
* selezionare elementi casuali;
* costruire algoritmi di generazione automatica;
* separare dati, logica e interfaccia utente.

---

# Descrizione del progetto

Il programma gestisce un archivio di eventi storici.

Ogni evento contiene informazioni come:

* anno;
* titolo;
* luogo;
* civiltà;
* categoria;
* personaggi coinvolti;
* descrizione;
* epoca storica.

Partendo da queste informazioni il programma deve costruire automaticamente una domanda.

Ad esempio, dall'evento:

> Fondazione di Roma — 753 a.C.

potrà essere generata la domanda:

> In quale anno è stata fondata Roma?

oppure

> Quale evento avvenne nel 753 a.C.?

oppure

> In quale periodo storico è collocata la fondazione di Roma?

---

# Fase 1 – Analisi dei dati

Analizzare la struttura del file JSON.

Individuare tutte le informazioni disponibili per ogni evento.

Ad esempio:

* identificativo
* anno
* titolo
* luogo
* civiltà
* categoria
* personaggi
* descrizione
* epoca

Domande da porsi:

* quali campi saranno sempre presenti?
* quali saranno facoltativi?
* quali saranno utilizzati per costruire le domande?

---

# Fase 2 – Progettazione delle classi

Progettare il modello ad oggetti.

Ad esempio:

* Evento
* Domanda
* Risposta
* GeneratoreQuiz
* ArchivioEventi

Valutare attentamente le responsabilità di ogni classe.

Ogni classe dovrebbe avere un unico compito.

---

# Fase 3 – Lettura del file JSON

L'applicazione deve caricare l'archivio degli eventi.

Il risultato dovrà essere una collezione di oggetti `Evento`.

Verificare che:

* tutti gli eventi siano stati caricati;
* non esistano dati mancanti;
* gli anni siano interpretati correttamente (sia a.C. sia d.C.).

---

# Fase 4 – Progettazione delle domande

Non creare le domande manualmente.

Definire invece alcuni modelli di domanda.

Ad esempio:

### Domande sull'anno

> In quale anno avvenne...

---

### Domande sul luogo

> Dove avvenne...

---

### Domande sul personaggio

> Chi fu...

---

### Domande sulla civiltà

> A quale civiltà apparteneva...

---

### Domande sulla categoria

> Questo evento appartiene alla categoria...

---

### Domande sull'epoca

> In quale periodo storico...

---

Ogni modello dovrà poter essere utilizzato con qualunque evento compatibile.

---

# Fase 5 – Costruzione delle risposte

Per ogni domanda occorre costruire:

* una risposta corretta;
* alcune risposte errate (distrattori).

Le risposte errate non devono essere casuali.

Ad esempio, se la domanda riguarda un anno, è preferibile proporre anni appartenenti allo stesso periodo storico.

Una buona domanda deve risultare credibile.

---

# Fase 6 – Distrattori intelligenti

Progettare un algoritmo capace di scegliere risposte plausibili.

Ad esempio:

* anni vicini;
* luoghi appartenenti alla stessa area geografica;
* personaggi della stessa epoca;
* civiltà contemporanee;
* eventi della stessa categoria.

L'obiettivo è aumentare la qualità del quiz.

---

# Fase 7 – Selezione casuale

Ogni esecuzione del programma dovrebbe:

* scegliere casualmente un evento;
* scegliere casualmente il tipo di domanda;
* costruire automaticamente il quiz.

In questo modo il numero di combinazioni aumenta enormemente.

---

# Fase 8 – Livelli di difficoltà

Prevedere almeno tre livelli.

### Facile

Distrattori molto diversi dalla risposta corretta.

---

### Medio

Distrattori appartenenti allo stesso periodo storico.

---

### Difficile

Distrattori estremamente simili alla risposta corretta.

Ad esempio, anni molto vicini oppure eventi della stessa civiltà.

---

# Fase 9 – Gestione della partita

Realizzare una semplice sessione di quiz.

Ad esempio:

* 10 domande casuali;
* una sola risposta corretta;
* conteggio del punteggio finale.

Al termine mostrare:

* numero di risposte corrette;
* numero di errori;
* percentuale di successo.

---

# Fase 10 – Estensioni

Il progetto può essere ampliato introducendo nuove funzionalità.

Ad esempio:

* scelta dell'epoca storica;
* scelta della difficoltà;
* domande vero/falso;
* ordinamento cronologico di più eventi;
* completamento di una frase;
* domande con immagini;
* ricerca degli eventi;
* statistiche dei risultati.

---

# Domande di riflessione

1. Perché è preferibile generare automaticamente le domande anziché memorizzarle tutte?

2. Quali vantaggi offre la separazione tra archivio degli eventi e motore del quiz?

3. In che modo si possono costruire distrattori credibili?

4. Come si può evitare che la stessa domanda venga proposta troppo frequentemente?

5. Quali informazioni aggiuntive potrebbero essere inserite negli eventi per generare nuove tipologie di quiz?

6. In che modo il programma potrebbe adattare automaticamente la difficoltà in base alle risposte dell'utente?

---

# Sfida finale

L'archivio fornito contiene circa **150 eventi storici**. Progettare il motore in modo da poter generare **almeno 1.000 domande differenti** senza aggiungere nuovi dati.

Come estensione, rendere il sistema completamente **data-driven**, in modo che l'aggiunta di nuovi eventi o di nuovi modelli di domanda non richieda modifiche al codice sorgente, ma soltanto l'aggiornamento dei file di configurazione. Questa soluzione rende il motore facilmente estendibile e riutilizzabile anche per altri argomenti, come geografia, scienze, letteratura o arte.
