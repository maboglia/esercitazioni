# Bollettini postali

scrivere un'applicazione **Web** che consente di **pagare bollettini** di conto corrente postale.

L'applicazione deve consentire di eseguire il seguente caso d'uso.

## “Utente paga bollettino”

* L'utente già registrato accede ad una vista iniziale (**index**) nel quale viene visualizzata una maschera per specificare i dati del bollettino da pagare.

E' necessario specificare:

* il conto corrente postale su cui effettuare il versamento (un numero di 6 cifre)
* il codice prestampato del bollettino (una sequenza di lettere e cifre)
* la causale del versamento
* l'importo in euro
* (es: pagamento del bollettino di codice 1453hdf6x sul conto corrente n. 345678 con la causale "pagamento bolletta").

Il sistema verifica che il conto corrente postale sia tra quelli abilitati al pagamento, presente in una tabella di beneficiari.

* I conti correnti abilitati sono memorizzati in una **tabella ContiCorrenti** che contiene il codice del conto corrente e il nome dell'intestatario (es: conto corrente n. 123456 intestato a EniGas).
* Se il conto corrente è tra quelli abilitati, l'utente accede ad una vista (**pagamento**) nel quale sono riassunti i dati relativi al bollettino;
* la vista contiene inoltre una maschera attraverso la quale l'utente fornisce 
  * (a) il suo nome e cognome; 
  * (b) il codice della sua carta di credito, 
  * predisporre anche un collegamento alla vista finale (**uscita**) per abbandonare l'applicazione.

Procedendo al pagamento, il sistema registra i dati in una **tabella Bollettini** in cui, per ciascun pagamento sono registrati il codice del bollettino, l'importo, la causale, il codice del conto del destinatario, il nome del pagatore ed il numero di carta di credito.

* L'utente accede ad una vista (**conferma**) nel quale vengono riassunti i risultati dell'operazione (dati del bollettino); 
* la vista contiene un collegamento alla vista iniziale nel caso l'utente voglia eseguire un ulteriore acquisto, ed un collegamento alla vista finale (**uscita**) per uscire dall'applicazione.
* La vista finale (**uscita**) contiene un messaggio di uscita ed un collegamento alla vista iniziale (**index**).

## Gestione errori

* Se il conto corrente del destinatario non è tra quelli abilitati l'utente accede ad una vista (**errore**) in cui viene visualizzato 
  * un messaggio di errore ed 
  * un collegamento alla vista principale per effettuare una nuova operazione

## Scrivere l'applicazione Web che effettua le operazioni elencate sopra secondo le seguenti specifiche:

* L'applicazione deve utilizzare pagine server-side.
* La grafica deve essere organizzata utilizzando un foglio di stile CSS.
* È necessario provvedere alla convalida dei dati sottomessi dall'utente.
* È necessario provvedere alla convalida del codice HTML prodotto dalle pagine server-side.
* È possibile usare framework per il backend e il frontend
* È possibile usare un approccio MVC, REST o un mix dei due con AJAX
