# Esercizio PHP: Quiz sui Paesi del Mondo

Realizzate un'applicazione **PHP** che metta alla prova le conoscenze geografiche degli utenti tramite un quiz sui paesi del mondo.

## Home Page

L'applicazione dispone di una **home page** che permette di scegliere tra:

* modalità **Allenamento**;
* modalità **Quiz**;
* eventuali funzionalità aggiuntive, ad esempio:

  * scelta del livello di difficoltà;
  * visualizzazione dello storico delle risposte;
  * giochi aggiuntivi;
  * consultazione delle statistiche.

---

## Vista Quiz

L'applicazione dispone di una pagina dedicata al quiz.

Ad ogni caricamento della pagina viene proposta una nuova domanda, ad esempio individuare la capitale di un paese, con tre possibili risposte, di cui una sola corretta.

In base al livello di difficoltà è possibile aumentare il numero delle opzioni disponibili.

---

## Descrizione del Quiz

Il quiz conterrà una serie di domande riguardanti vari aspetti dei paesi del mondo, ad esempio:

* capitale;
* lingua ufficiale;
* popolazione;
* bandiera;
* continente;
* valuta.

Esempio di domanda:

**Qual è la capitale dell'Italia?**

1. Roma
2. Madrid
3. Berlino

La risposta corretta è **Roma**.

---

## Vista Allenamento

Questa modalità permette di visualizzare le informazioni una alla volta per facilitarne la memorizzazione.

Per ogni paese possono essere mostrati:

* nome;
* bandiera;
* capitale;
* lingua;
* popolazione;
* continente;
* altre informazioni utili.

---

# Implementazione del progetto PHP

## Architettura

Organizzare il progetto utilizzando file PHP suddivisi in modo ordinato, ad esempio:

* `index.php` (home page)
* `quiz.php`
* `allenamento.php`
* `risultato.php`
* cartella `classes/` per le classi PHP
* cartella `data/` per i file contenenti i dati
* cartella `assets/` per immagini, CSS e JavaScript.

È consigliato separare la logica dell'applicazione dalla presentazione.

---

## Classi suggerite

1. Definire una classe `Domanda` che rappresenti una singola domanda del quiz. Ogni domanda conterrà:

   * testo della domanda;
   * risposta corretta;
   * risposte errate;
   * eventuale livello di difficoltà.

2. Creare una classe `Quiz` che gestisca la logica del quiz. Questa classe dovrà:

   * caricare le domande;
   * selezionare una domanda casuale;
   * verificare la risposta;
   * calcolare il punteggio.

3. Creare una classe `GestoreDomande` (oppure `RepositoryDomande`) che si occupi del caricamento delle domande da una sorgente dati.

---

## Gestione dei dati

Le domande possono essere memorizzate in:

* file CSV;
* file JSON;
* database MySQL (opzionale).

Ogni record conterrà almeno:

* domanda;
* risposta corretta;
* risposte errate;
* categoria;
* livello.

---

## Gestione della sessione

Utilizzare le **sessioni PHP** per memorizzare:

* punteggio corrente;
* numero della domanda;
* risposte già date;
* livello scelto dall'utente.

---

# Funzionalità aggiuntive

Per arricchire il progetto è possibile implementare una o più delle seguenti funzionalità:

* timer per ogni domanda;
* calcolo del punteggio finale;
* livelli di difficoltà;
* domande bonus;
* domande con più risposte corrette;
* salvataggio dei migliori punteggi;
* modalità allenamento con immagini e bandiere;
* gioco del Memory utilizzando le bandiere dei paesi;
* utilizzo di un database MySQL per la gestione dei dati;
* autenticazione degli utenti;
* pannello amministratore per inserire e modificare le domande;
* separazione dell'applicazione secondo un'architettura a livelli:

  * Entity;
  * Repository;
  * Service;
  * Controller;
* implementazione con approccio MVC (Model-View-Controller);
* utilizzo di template engine oppure framework PHP (ad esempio Laravel o Symfony) per i gruppi che desiderano realizzare una versione avanzata.

---

# Requisiti di qualità del codice

L'applicazione dovrà:

* utilizzare la programmazione orientata agli oggetti (OOP);
* organizzare il codice in classi e metodi significativi;
* evitare duplicazioni di codice;
* separare la logica dalla presentazione;
* utilizzare nomi chiari per variabili, metodi e classi;
* produrre un'interfaccia semplice e intuitiva.

Per i gruppi che desiderano approfondire, è possibile utilizzare framework e librerie PHP, mantenendo comunque chiara la struttura del progetto e la logica implementata.
