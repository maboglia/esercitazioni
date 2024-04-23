# libreria

scrivere un'applicazione Web relativa ad un sito per la vendita di libri. 

L'applicazione deve consentire di eseguire il seguente caso d'uso.

“Utente acquista libro”

Scenario Principale

* L'utente accede ad uno schermo iniziale (index.PHP) nel quale viene visualizzata una maschera per
specificare il titolo del libro da acquistare
* Il sistema verifica che nella base di dati esista un libro con il titolo specificato. I libri venduti sono
memorizzati in una tabella Libri della base di dati che contiene il codice del libro, il titolo, l'autore, il
prezzo e il numero di copie disponibili.
* Se il libro esiste ed è disponibile almeno una copia, l'utente accede ad uno schermo (acquisto.PHP) nel
quale sono riassunti i dati relativi al libro; lo schermo contiene inoltre una maschera attraverso la quale
l'utente fornisce (a) il suo nome e cognome; (b) il codice della sua carta di credito
* Procedendo all'acquisto, il sistema aggiorna il numero di copie disponibili del libro nella base di dati.
NOTA: non è necessario registrare nella base di dati i dati relativi all'acquisto. L'utente accede ad uno
schermo (conferma.PHP) nel quale vengono riassunti i risultati dell'operazione (dati del libro e
dell'acquisto); lo schermo contiene un collegamento allo schermo iniziale nel caso l'utente voglia
eseguire un ulteriore acquisto
Scenario alternativo: Il libro non esiste oppure il numero di copie è pari a 0
* L'utente accede ad uno schermo (errore.PHP) in cui viene visualizzato un messaggio di errore ed un
collegamento allo schermo principale per effettuare una nuova operazione
Scrivere l'applicazione Web che effettua le operazioni elencate sopra secondo le seguenti specifiche:
* L'applicazione deve utilizzare pagine PHP e un'architettura di tipo Modello 1.
* La grafica deve essere organizzata utilizzando un foglio di stile CSS.
* Non è necessario provvedere alla convalida dei dati sottomessi dall'utente.
* Non è necessario provvedere alla convalida del codice HTML prodotto dalle pagine PHP.
